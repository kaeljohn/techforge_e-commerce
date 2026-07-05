<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Cpu;
use App\Models\Gpu;
use App\Models\Motherboard;
use App\Models\Ram;
use App\Models\Storage;
use App\Models\PowerSupply;
use App\Models\PcCase;
use App\Models\PrebuiltConfig;

class PrebuiltConfigsSeeder extends Seeder
{
    public function run(): void
    {
        $cpus = [
            'Ryzen 5 9600X' => Cpu::create(['name' => 'Ryzen 5 9600X', 'price' => 299.99, 'socket' => 'AM5', 'tdp' => 65]),
            'Ryzen 7 9800X3D' => Cpu::create(['name' => 'Ryzen 7 9800X3D', 'price' => 449.99, 'socket' => 'AM5', 'tdp' => 120]),
            'Ryzen 9 9950X3D' => Cpu::create(['name' => 'Ryzen 9 9950X3D', 'price' => 699.99, 'socket' => 'AM5', 'tdp' => 170]),
            'Core Ultra 5 245K' => Cpu::create(['name' => 'Core Ultra 5 245K', 'price' => 289.99, 'socket' => 'LGA 1851', 'tdp' => 125]),
            'Core Ultra 7 265K' => Cpu::create(['name' => 'Core Ultra 7 265K', 'price' => 399.99, 'socket' => 'LGA 1851', 'tdp' => 125]),
            'Core Ultra 9 285K' => Cpu::create(['name' => 'Core Ultra 9 285K', 'price' => 589.99, 'socket' => 'LGA 1851', 'tdp' => 125]),
        ];

        $gpus = [
            'RTX 5060 8GB' => Gpu::create(['name' => 'RTX 5060 8GB', 'price' => 299.99, 'tdp' => 115, 'length_mm' => 240]),
            'RTX 5060 Ti 8GB' => Gpu::create(['name' => 'RTX 5060 Ti 8GB', 'price' => 399.99, 'tdp' => 160, 'length_mm' => 260]),
            'RTX 5070 12GB' => Gpu::create(['name' => 'RTX 5070 12GB', 'price' => 599.99, 'tdp' => 200, 'length_mm' => 280]),
            'RTX 5080 16GB' => Gpu::create(['name' => 'RTX 5080 16GB', 'price' => 999.99, 'tdp' => 320, 'length_mm' => 320]),
            'RTX 5090 32GB' => Gpu::create(['name' => 'RTX 5090 32GB', 'price' => 1599.99, 'tdp' => 450, 'length_mm' => 340]),
        ];

        $mobos = [
            'B850 ATX' => Motherboard::create(['name' => 'B850 ATX', 'price' => 149.99, 'socket' => 'AM5', 'form_factor' => 3, 'supported_ram_gen' => 'DDR5']),
            'X870 ATX' => Motherboard::create(['name' => 'X870 ATX', 'price' => 249.99, 'socket' => 'AM5', 'form_factor' => 3, 'supported_ram_gen' => 'DDR5']),
            'X870E E-ATX' => Motherboard::create(['name' => 'X870E E-ATX', 'price' => 399.99, 'socket' => 'AM5', 'form_factor' => 4, 'supported_ram_gen' => 'DDR5']),
            'Z890 ATX' => Motherboard::create(['name' => 'Z890 ATX', 'price' => 229.99, 'socket' => 'LGA 1851', 'form_factor' => 3, 'supported_ram_gen' => 'DDR5']),
            'Z890 E-ATX' => Motherboard::create(['name' => 'Z890 E-ATX', 'price' => 499.99, 'socket' => 'LGA 1851', 'form_factor' => 4, 'supported_ram_gen' => 'DDR5']),
        ];

        $rams = [
            '32GB DDR5-6000' => Ram::create(['name' => '32GB DDR5-6000', 'price' => 99.99, 'generation' => 'DDR5', 'capacity' => 32, 'speed' => 6000]),
            '64GB DDR5-6000' => Ram::create(['name' => '64GB DDR5-6000', 'price' => 189.99, 'generation' => 'DDR5', 'capacity' => 64, 'speed' => 6000]),
            '32GB DDR5-6400' => Ram::create(['name' => '32GB DDR5-6400', 'price' => 119.99, 'generation' => 'DDR5', 'capacity' => 32, 'speed' => 6400]),
            '64GB DDR5-7200' => Ram::create(['name' => '64GB DDR5-7200', 'price' => 249.99, 'generation' => 'DDR5', 'capacity' => 64, 'speed' => 7200]),
        ];

        $storages = [
            '1TB NVMe Gen4' => Storage::create(['name' => '1TB NVMe Gen4', 'price' => 79.99, 'type' => 'NVMe Gen4', 'capacity' => 1000]),
            '2TB NVMe Gen4' => Storage::create(['name' => '2TB NVMe Gen4', 'price' => 139.99, 'type' => 'NVMe Gen4', 'capacity' => 2000]),
            '4TB NVMe Gen5' => Storage::create(['name' => '4TB NVMe Gen5', 'price' => 349.99, 'type' => 'NVMe Gen5', 'capacity' => 4000]),
        ];

        $psus = [
            '650W PSU' => PowerSupply::create(['name' => '650W PSU', 'price' => 79.99, 'wattage' => 650, 'form_factor' => 'ATX']),
            '750W PSU' => PowerSupply::create(['name' => '750W PSU', 'price' => 99.99, 'wattage' => 750, 'form_factor' => 'ATX']),
            '850W PSU' => PowerSupply::create(['name' => '850W PSU', 'price' => 129.99, 'wattage' => 850, 'form_factor' => 'ATX']),
            '1000W PSU' => PowerSupply::create(['name' => '1000W PSU', 'price' => 199.99, 'wattage' => 1000, 'form_factor' => 'ATX']),
        ];

        $cases = [
            'TechForge ATX Case' => PcCase::create(['name' => 'TechForge ATX Case', 'price' => 89.99, 'max_mobo_size' => 3, 'max_gpu_length' => 330]),
            'TechForge Premium E-ATX Case' => PcCase::create(['name' => 'TechForge Premium E-ATX Case', 'price' => 149.99, 'max_mobo_size' => 4, 'max_gpu_length' => 400]),
        ];

        $builds = [
            [
                'name' => 'AMD 1080p Sweet Spot',
                'description' => 'Perfect balance for high-refresh 1080p gaming.',
                'cpu_id' => $cpus['Ryzen 5 9600X']->id,
                'gpu_id' => $gpus['RTX 5060 8GB']->id,
                'motherboard_id' => $mobos['B850 ATX']->id,
                'ram_id' => $rams['32GB DDR5-6000']->id,
                'storage_id' => $storages['1TB NVMe Gen4']->id,
                'power_supply_id' => $psus['650W PSU']->id,
                'pc_case_id' => $cases['TechForge ATX Case']->id,
                'price' => 1100,
                'image_url' => 'https://images.unsplash.com/photo-1587202372775-e229f172b9d7?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            ],
            [
                'name' => 'AMD 4K High-End',
                'description' => 'Uncompromised 4K performance for demanding titles.',
                'cpu_id' => $cpus['Ryzen 7 9800X3D']->id,
                'gpu_id' => $gpus['RTX 5070 12GB']->id,
                'motherboard_id' => $mobos['X870 ATX']->id,
                'ram_id' => $rams['32GB DDR5-6000']->id,
                'storage_id' => $storages['2TB NVMe Gen4']->id,
                'power_supply_id' => $psus['750W PSU']->id,
                'pc_case_id' => $cases['TechForge ATX Case']->id,
                'price' => 1800,
                'image_url' => 'https://images.unsplash.com/photo-1547082299-de196ea013d6?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            ],
            [
                'name' => 'AMD Enthusiast',
                'description' => 'The absolute pinnacle of AMD computing power.',
                'cpu_id' => $cpus['Ryzen 9 9950X3D']->id,
                'gpu_id' => $gpus['RTX 5090 32GB']->id,
                'motherboard_id' => $mobos['X870E E-ATX']->id,
                'ram_id' => $rams['64GB DDR5-6000']->id,
                'storage_id' => $storages['4TB NVMe Gen5']->id,
                'power_supply_id' => $psus['1000W PSU']->id,
                'pc_case_id' => $cases['TechForge Premium E-ATX Case']->id,
                'price' => 3600,
                'image_url' => 'https://images.unsplash.com/photo-1593640408182-31c70c8268f5?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            ],
            [
                'name' => 'Intel 1080p Sweet Spot',
                'description' => 'Smooth 1080p gaming with Intel reliability.',
                'cpu_id' => $cpus['Core Ultra 5 245K']->id,
                'gpu_id' => $gpus['RTX 5060 Ti 8GB']->id,
                'motherboard_id' => $mobos['Z890 ATX']->id,
                'ram_id' => $rams['32GB DDR5-6000']->id,
                'storage_id' => $storages['1TB NVMe Gen4']->id,
                'power_supply_id' => $psus['750W PSU']->id,
                'pc_case_id' => $cases['TechForge ATX Case']->id,
                'price' => 1300,
                'image_url' => 'https://images.unsplash.com/photo-1555680202-c86f0e12f086?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            ],
            [
                'name' => 'Intel 4K High-End',
                'description' => 'Premium 4K gaming and productivity.',
                'cpu_id' => $cpus['Core Ultra 7 265K']->id,
                'gpu_id' => $gpus['RTX 5080 16GB']->id,
                'motherboard_id' => $mobos['Z890 ATX']->id,
                'ram_id' => $rams['32GB DDR5-6400']->id,
                'storage_id' => $storages['2TB NVMe Gen4']->id,
                'power_supply_id' => $psus['850W PSU']->id,
                'pc_case_id' => $cases['TechForge ATX Case']->id,
                'price' => 2200,
                'image_url' => 'https://images.unsplash.com/photo-1525547719571-a2d4ac8945e2?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            ],
            [
                'name' => 'Intel Enthusiast',
                'description' => 'Ultimate Intel performance without compromise.',
                'cpu_id' => $cpus['Core Ultra 9 285K']->id,
                'gpu_id' => $gpus['RTX 5090 32GB']->id,
                'motherboard_id' => $mobos['Z890 E-ATX']->id,
                'ram_id' => $rams['64GB DDR5-7200']->id,
                'storage_id' => $storages['4TB NVMe Gen5']->id,
                'power_supply_id' => $psus['1000W PSU']->id,
                'pc_case_id' => $cases['TechForge Premium E-ATX Case']->id,
                'price' => 4200,
                'image_url' => 'https://images.unsplash.com/photo-1600861194942-f883de0dfe96?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            ],
        ];

        foreach ($builds as $build) {
            PrebuiltConfig::create($build);
        }
    }
}