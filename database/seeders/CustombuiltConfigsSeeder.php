<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CustombuiltConfig;
use App\Models\Cpu;
use App\Models\Gpu;
use App\Models\Motherboard;
use App\Models\Ram;
use App\Models\Storage;
use App\Models\PowerSupply;
use App\Models\PcCase;

class CustombuiltConfigsSeeder extends Seeder
{
    public function run(): void
    {
        CustombuiltConfig::truncate();

        $builds = [
            // AMD Builds
            [
                'name' => 'Custom AMD Entry Level',
                'description' => 'A great starting point for custom AMD builds.',
                'platform' => 'AMD',
                'tier' => 'Entry Level',
                'cpu_id' => Cpu::where('name', 'Ryzen 5 9600X')->firstOrFail()->id,
                'gpu_id' => Gpu::where('name', 'RTX 5060 8GB')->firstOrFail()->id,
                'motherboard_id' => Motherboard::where('name', 'B850 ATX')->firstOrFail()->id,
                'ram_id' => Ram::where('name', '32GB DDR5-6000')->firstOrFail()->id,
                'storage_id' => Storage::where('name', '1TB NVMe Gen4')->firstOrFail()->id,
                'power_supply_id' => PowerSupply::where('name', '650W PSU')->firstOrFail()->id,
                'pc_case_id' => PcCase::where('name', 'TechForge ATX Case')->firstOrFail()->id,
                'price' => 1150,
                'image_url' => 'https://images.unsplash.com/photo-1587202372775-e229f172b9d7?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            ],
            [
                'name' => 'Custom AMD Mainstream',
                'description' => 'Perfect balance for 1440p gaming and productivity.',
                'platform' => 'AMD',
                'tier' => 'Mainstream',
                'cpu_id' => Cpu::where('name', 'Ryzen 7 9800X3D')->firstOrFail()->id,
                'gpu_id' => Gpu::where('name', 'RTX 5070 12GB')->firstOrFail()->id,
                'motherboard_id' => Motherboard::where('name', 'X870 ATX')->firstOrFail()->id,
                'ram_id' => Ram::where('name', '32GB DDR5-6000')->firstOrFail()->id,
                'storage_id' => Storage::where('name', '2TB NVMe Gen4')->firstOrFail()->id,
                'power_supply_id' => PowerSupply::where('name', '750W PSU')->firstOrFail()->id,
                'pc_case_id' => PcCase::where('name', 'TechForge ATX Case')->firstOrFail()->id,
                'price' => 1850,
                'image_url' => 'https://images.unsplash.com/photo-1547082299-de196ea013d6?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            ],
            [
                'name' => 'Custom AMD Enthusiast',
                'description' => 'Top-tier performance for hardcore gamers and creators.',
                'platform' => 'AMD',
                'tier' => 'Enthusiast',
                'cpu_id' => Cpu::where('name', 'Ryzen 9 9950X3D')->firstOrFail()->id,
                'gpu_id' => Gpu::where('name', 'RTX 5090 32GB')->firstOrFail()->id,
                'motherboard_id' => Motherboard::where('name', 'X870E E-ATX')->firstOrFail()->id,
                'ram_id' => Ram::where('name', '64GB DDR5-6000')->firstOrFail()->id,
                'storage_id' => Storage::where('name', '4TB NVMe Gen5')->firstOrFail()->id,
                'power_supply_id' => PowerSupply::where('name', '1000W PSU')->firstOrFail()->id,
                'pc_case_id' => PcCase::where('name', 'TechForge Premium E-ATX Case')->firstOrFail()->id,
                'price' => 3700,
                'image_url' => 'https://images.unsplash.com/photo-1593640408182-31c70c8268f5?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            ],
            // Intel Builds
            [
                'name' => 'Custom Intel Entry Level',
                'description' => 'Reliable Intel architecture for 1080p gaming.',
                'platform' => 'Intel',
                'tier' => 'Entry Level',
                'cpu_id' => Cpu::where('name', 'Core Ultra 5 245K')->firstOrFail()->id,
                'gpu_id' => Gpu::where('name', 'RTX 5060 Ti 8GB')->firstOrFail()->id,
                'motherboard_id' => Motherboard::where('name', 'Z890 ATX')->firstOrFail()->id,
                'ram_id' => Ram::where('name', '32GB DDR5-6000')->firstOrFail()->id,
                'storage_id' => Storage::where('name', '1TB NVMe Gen4')->firstOrFail()->id,
                'power_supply_id' => PowerSupply::where('name', '750W PSU')->firstOrFail()->id,
                'pc_case_id' => PcCase::where('name', 'TechForge ATX Case')->firstOrFail()->id,
                'price' => 1350,
                'image_url' => 'https://images.unsplash.com/photo-1555680202-c86f0e12f086?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            ],
            [
                'name' => 'Custom Intel Mainstream',
                'description' => 'Solid 1440p gaming performance powered by Intel.',
                'platform' => 'Intel',
                'tier' => 'Mainstream',
                'cpu_id' => Cpu::where('name', 'Core Ultra 7 265K')->firstOrFail()->id,
                'gpu_id' => Gpu::where('name', 'RTX 5080 16GB')->firstOrFail()->id,
                'motherboard_id' => Motherboard::where('name', 'Z890 ATX')->firstOrFail()->id,
                'ram_id' => Ram::where('name', '32GB DDR5-6400')->firstOrFail()->id,
                'storage_id' => Storage::where('name', '2TB NVMe Gen4')->firstOrFail()->id,
                'power_supply_id' => PowerSupply::where('name', '850W PSU')->firstOrFail()->id,
                'pc_case_id' => PcCase::where('name', 'TechForge ATX Case')->firstOrFail()->id,
                'price' => 2250,
                'image_url' => 'https://images.unsplash.com/photo-1525547719571-a2d4ac8945e2?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            ],
            [
                'name' => 'Custom Intel Enthusiast',
                'description' => 'Extreme Intel power for the most demanding tasks.',
                'platform' => 'Intel',
                'tier' => 'Enthusiast',
                'cpu_id' => Cpu::where('name', 'Core Ultra 9 285K')->firstOrFail()->id,
                'gpu_id' => Gpu::where('name', 'RTX 5090 32GB')->firstOrFail()->id,
                'motherboard_id' => Motherboard::where('name', 'Z890 E-ATX')->firstOrFail()->id,
                'ram_id' => Ram::where('name', '64GB DDR5-7200')->firstOrFail()->id,
                'storage_id' => Storage::where('name', '4TB NVMe Gen5')->firstOrFail()->id,
                'power_supply_id' => PowerSupply::where('name', '1000W PSU')->firstOrFail()->id,
                'pc_case_id' => PcCase::where('name', 'TechForge Premium E-ATX Case')->firstOrFail()->id,
                'price' => 4300,
                'image_url' => 'https://images.unsplash.com/photo-1600861194942-f883de0dfe96?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            ],
        ];

        foreach ($builds as $build) {
            CustombuiltConfig::create($build);
        }
    }
}