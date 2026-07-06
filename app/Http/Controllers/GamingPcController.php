<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PrebuiltConfig;
use App\Models\CustombuiltConfig;
use Illuminate\Pagination\LengthAwarePaginator;

class GamingPcController extends Controller
{
    public function index(Request $request)
    {
        $allPrebuiltConfigs = PrebuiltConfig::with(['cpu', 'gpu', 'ram', 'storage'])->get();
        $allCustomConfigs = CustombuiltConfig::with(['cpu', 'gpu', 'ram', 'storage'])->get();
        
        $allConfigs = $allPrebuiltConfigs->concat($allCustomConfigs);
        
        $counts = [
            'processors' => [],
            'gpus' => [],
            'rams' => [],
            'storages' => [],
        ];

        foreach ($allConfigs as $config) {
            $procName = $config->cpu->name;
            if (str_contains($procName, 'Ryzen')) $procName = 'AMD ' . $procName;
            elseif (str_contains($procName, 'Core')) $procName = 'Intel ' . $procName;
            $counts['processors'][$procName] = ($counts['processors'][$procName] ?? 0) + 1;

            $gpuName = $config->gpu->name;
            if (str_contains($gpuName, 'RTX') || str_contains($gpuName, 'GTX')) $gpuName = 'NVIDIA ' . $gpuName;
            elseif (str_contains($gpuName, 'RX')) $gpuName = 'AMD ' . $gpuName;
            $counts['gpus'][$gpuName] = ($counts['gpus'][$gpuName] ?? 0) + 1;

            $ramName = $config->ram->name;
            $counts['rams'][$ramName] = ($counts['rams'][$ramName] ?? 0) + 1;

            $storageName = $config->storage->name;
            $counts['storages'][$storageName] = ($counts['storages'][$storageName] ?? 0) + 1;
        }

        // Apply filters
        $prebuiltQuery = PrebuiltConfig::with(['cpu', 'gpu', 'motherboard', 'ram', 'storage', 'powerSupply']);
        $customQuery = CustombuiltConfig::with(['cpu', 'gpu', 'motherboard', 'ram', 'storage', 'powerSupply']);

        $prebuiltQuery = $this->applyFilters($prebuiltQuery, $request);
        $customQuery = $this->applyFilters($customQuery, $request);

        $filteredConfigs = $prebuiltQuery->get()->concat($customQuery->get());

        $sort = $request->input('sort', 'Recommended');
        if ($sort === 'Price: Low to High') {
            $filteredConfigs = $filteredConfigs->sortBy('price')->values();
        } elseif ($sort === 'Price: High to Low') {
            $filteredConfigs = $filteredConfigs->sortByDesc('price')->values();
        } elseif ($sort === 'Newest Arrivals') {
            $filteredConfigs = $filteredConfigs->sortByDesc('created_at')->values();
        } else {
            $filteredConfigs = $filteredConfigs->sortBy('id')->values();
        }

        $page = $request->input('page', 1);
        $perPage = 6;
        $configs = new LengthAwarePaginator(
            $filteredConfigs->forPage($page, $perPage),
            $filteredConfigs->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        $minPrices = array_filter([
            PrebuiltConfig::min('price'),
            CustombuiltConfig::min('price'),
        ]);
        $globalMinPrice = !empty($minPrices) ? floor(min($minPrices)) : 0;

        $maxPrices = array_filter([
            PrebuiltConfig::max('price'),
            CustombuiltConfig::max('price'),
        ]);
        $globalMaxPrice = !empty($maxPrices) ? ceil(max($maxPrices)) : 250000;

        return view('gaming-pcs', compact('configs', 'counts', 'globalMinPrice', 'globalMaxPrice'));
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
                        $subQ->whereIn('name', $cleanedProcs);
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
                        $subQ->whereIn('name', $cleanedGpus);
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
                            $capInt = (int)str_replace('GB', '', $cap);
                            $subQ->orWhere('capacity', $capInt);
                        }
                    }
                });
            });
        }

        if ($request->filled('storage')) {
            $query->whereHas('storage', function($q) use ($request) {
                $storages = $request->storage ?? [];
                $q->where(function($subQ) use ($storages) {
                    foreach ($storages as $storage) {
                        $subQ->orWhere('name', 'LIKE', $storage . '%');
                    }
                });
            });
        }

        return $query;
    }
}