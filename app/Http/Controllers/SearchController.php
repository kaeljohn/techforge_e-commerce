<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PrebuiltConfig;
use App\Models\CustombuiltConfig;
use App\Models\Cpu;
use App\Models\Gpu;
use App\Models\Motherboard;
use App\Models\Ram;
use App\Models\Storage;
use App\Models\PowerSupply;
use App\Models\PcCase;
use Illuminate\Pagination\LengthAwarePaginator;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->query('q', '');
        $tab = $request->query('tab', 'prebuilt');

        // 1. PREBUILT
        $prebuiltBaseQuery = PrebuiltConfig::with(['cpu', 'gpu', 'motherboard', 'ram', 'storage', 'powerSupply']);
        if ($query) {
            $prebuiltBaseQuery->where(function($q) use ($query) {
                $q->where('name', 'LIKE', '%' . $query . '%')
                  ->orWhereHas('cpu', function($sub) use ($query) {
                      $sub->where('name', 'LIKE', '%' . $query . '%');
                  })
                  ->orWhereHas('gpu', function($sub) use ($query) {
                      $sub->where('name', 'LIKE', '%' . $query . '%');
                  });
            });
        }
        $prebuiltCount = (clone $prebuiltBaseQuery)->count();

        // 2. CUSTOM
        $customBaseQuery = CustombuiltConfig::with(['cpu', 'gpu', 'motherboard', 'ram', 'storage', 'powerSupply']);
        if ($query) {
            $customBaseQuery->where(function($q) use ($query) {
                $q->where('name', 'LIKE', '%' . $query . '%')
                  ->orWhereHas('cpu', function($sub) use ($query) {
                      $sub->where('name', 'LIKE', '%' . $query . '%');
                  })
                  ->orWhereHas('gpu', function($sub) use ($query) {
                      $sub->where('name', 'LIKE', '%' . $query . '%');
                  });
            });
        }
        $customCount = (clone $customBaseQuery)->count();

        // 3. PARTS
        $parts = collect();
        $partModels = [
            Cpu::class, Gpu::class, Motherboard::class, Ram::class, Storage::class, PowerSupply::class, PcCase::class
        ];
        
        foreach ($partModels as $modelClass) {
            $modelQuery = $modelClass::query();
            if ($query) {
                $modelQuery->where('name', 'LIKE', '%' . $query . '%');
            }
            $res = $modelQuery->get();
            // Assign a dummy category to identify it's a part
            $res->transform(function ($item) {
                $item->is_part = true;
                return $item;
            });
            $parts = $parts->concat($res);
        }
        $partsCount = $parts->count();

        // 4. LAPTOPS (Hardcoded to 0)
        $laptopCount = 0;

        $counts = [
            'processors' => [],
            'gpus' => [],
            'rams' => [],
            'storages' => [],
        ];

        // 5. Handle Tab Specifics
        $configs = collect();
        
        if ($tab === 'prebuilt') {
            $unfiltered = (clone $prebuiltBaseQuery)->get();
            $this->populateFilterCounts($unfiltered, $counts);
            
            $configs = $unfiltered;
            
        } elseif ($tab === 'custom') {
            $unfiltered = (clone $customBaseQuery)->get();
            $this->populateFilterCounts($unfiltered, $counts);
            
            $configs = $unfiltered;
            
        } elseif ($tab === 'parts') {
            $configs = $parts;
        } elseif ($tab === 'laptops') {
            $configs = collect([]);
        }

        $totalResults = $prebuiltCount + $customCount + $partsCount + $laptopCount;

        $partModels = [\App\Models\Cpu::class, \App\Models\Gpu::class, \App\Models\Motherboard::class, \App\Models\Ram::class, \App\Models\Storage::class, \App\Models\PowerSupply::class, \App\Models\PcCase::class];
        
        $minPricesArr = [
            \App\Models\PrebuiltConfig::min('price'),
            \App\Models\CustombuiltConfig::min('price'),
        ];
        $maxPricesArr = [
            \App\Models\PrebuiltConfig::max('price'),
            \App\Models\CustombuiltConfig::max('price'),
        ];

        foreach ($partModels as $modelClass) {
            $minPricesArr[] = $modelClass::min('price');
            $maxPricesArr[] = $modelClass::max('price');
        }

        $minPrices = array_filter($minPricesArr);
        $globalMinPrice = !empty($minPrices) ? floor(min($minPrices)) : 0;

        $maxPrices = array_filter($maxPricesArr);
        $globalMaxPrice = !empty($maxPrices) ? ceil(max($maxPrices)) : 250000;

        return view('search', compact(
            'query', 'tab', 'prebuiltCount', 'customCount', 
            'partsCount', 'laptopCount', 'counts', 'configs', 'totalResults',
            'globalMinPrice', 'globalMaxPrice'
        ));
    }

    private function populateFilterCounts($allConfigs, &$counts)
    {
        foreach ($allConfigs as $config) {
            if (!$config->cpu || !$config->gpu || !$config->ram || !$config->storage) continue;
            
            $procName = $config->cpu->name;
            if (!str_starts_with($procName, 'AMD') && str_contains($procName, 'Ryzen')) $procName = 'AMD ' . $procName;
            elseif (!str_starts_with($procName, 'Intel') && str_contains($procName, 'Core')) $procName = 'Intel ' . $procName;
            $counts['processors'][$procName] = ($counts['processors'][$procName] ?? 0) + 1;

            $gpuName = $config->gpu->name;
            if (!str_starts_with($gpuName, 'NVIDIA') && (str_contains($gpuName, 'RTX') || str_contains($gpuName, 'GTX'))) $gpuName = 'NVIDIA ' . $gpuName;
            elseif (!str_starts_with($gpuName, 'AMD') && str_contains($gpuName, 'RX')) $gpuName = 'AMD ' . $gpuName;
            $counts['gpus'][$gpuName] = ($counts['gpus'][$gpuName] ?? 0) + 1;

            $ramName = $config->ram->name;
            $counts['rams'][$ramName] = ($counts['rams'][$ramName] ?? 0) + 1;

            $storageName = $config->storage->name;
            $counts['storages'][$storageName] = ($counts['storages'][$storageName] ?? 0) + 1;
        }
    }

    private function applyFilters($query, Request $request)
    {
        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }
        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        if ($request->filled('processor') || $request->filled('processor_brand')) {
            $query->whereHas('cpu', function($q) use ($request) {
                $procs = $request->processor ?? [];
                $brands = $request->processor_brand ?? [];

                $q->where(function($subQ) use ($procs, $brands) {
                    if (!empty($procs)) {
                        $cleanedProcs = array_map(function($p) {
                            return str_replace(['AMD ', 'Intel '], '', $p);
                        }, $procs);
                        $subQ->where(function($q) use ($procs, $cleanedProcs) {
                            $q->whereIn('name', $procs)
                              ->orWhereIn('name', $cleanedProcs);
                        });
                    }
                    if (!empty($brands)) {
                        foreach ($brands as $brand) {
                            if ($brand === 'AMD') $subQ->orWhere('name', 'LIKE', '%Ryzen%');
                            if ($brand === 'Intel') $subQ->orWhere('name', 'LIKE', '%Core%');
                        }
                    }
                });
            });
        }

        if ($request->filled('gpu') || $request->filled('gpu_brand')) {
            $query->whereHas('gpu', function($q) use ($request) {
                $gpus = $request->gpu ?? [];
                $brands = $request->gpu_brand ?? [];

                $q->where(function($subQ) use ($gpus, $brands) {
                    if (!empty($gpus)) {
                        $cleanedGpus = array_map(function($g) {
                            return str_replace(['NVIDIA ', 'AMD '], '', $g);
                        }, $gpus);
                        $subQ->where(function($q) use ($gpus, $cleanedGpus) {
                            $q->whereIn('name', $gpus)
                              ->orWhereIn('name', $cleanedGpus);
                        });
                    }
                    if (!empty($brands)) {
                        foreach ($brands as $brand) {
                            if ($brand === 'NVIDIA') $subQ->orWhere('name', 'LIKE', '%RTX%')->orWhere('name', 'LIKE', '%GTX%');
                            if ($brand === 'AMD') $subQ->orWhere('name', 'LIKE', '%RX%');
                        }
                    }
                });
            });
        }

        if ($request->filled('ram') || $request->filled('ram_capacity')) {
            $query->whereHas('ram', function($q) use ($request) {
                $rams = $request->ram ?? [];
                $capacities = $request->ram_capacity ?? [];

                $q->where(function($subQ) use ($rams, $capacities) {
                    if (!empty($rams)) {
                        $subQ->whereIn('name', $rams);
                    }
                    if (!empty($capacities)) {
                        foreach ($capacities as $cap) {
                            $subQ->orWhere('name', 'LIKE', $cap . '%');
                        }
                    }
                });
            });
        }

        $sort = $request->sort ?? 'Recommended';
        if ($sort === 'Price: Low to High') {
            $query->orderBy('price', 'asc');
        } elseif ($sort === 'Price: High to Low') {
            $query->orderBy('price', 'desc');
        } else {
            $query->orderBy('price', 'desc'); 
        }

        return $query;
    }
}
