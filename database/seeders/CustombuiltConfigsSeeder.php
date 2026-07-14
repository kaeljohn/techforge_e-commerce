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

        // Intel Mainstream
        CustombuiltConfig::create([
            'name' => 'Intel Gaming Config 1: Mainstream / 1080p Performer',
            'description' => 'A great starting point for 1080p gaming.',
            'price' => 35000,
            'image_url' => 'https://images.unsplash.com/photo-1587202372775-e229f172b9d7?w=800&q=80',
            'platform' => 'Intel',
            'tier' => 'Mainstream',
            'rating' => rand(40, 50) / 10,
            'review_count' => rand(15, 120),
            'cpu_id' => Cpu::where('name', 'Intel Core Ultra 5 250K Plus (18-Core)')->first()->id ?? 1,
            'gpu_id' => Gpu::where('name', 'NVIDIA GeForce RTX 5060 Ti 16GB')->first()->id ?? 1,
            'motherboard_id' => Motherboard::where('name', 'MSI PRO Z890-P WIFI')->first()->id ?? 1,
            'ram_id' => Ram::where('name', '32GB (2x16GB) DDR5-6400')->first()->id ?? 1,
            'storage_id' => Storage::where('name', '1TB NVMe PCIe 4.0 SSD')->first()->id ?? 1,
            'power_supply_id' => PowerSupply::where('name', '650W 80+ Gold')->first()->id ?? 1,
            'pc_case_id' => PcCase::where('name', 'Fractal Design Pop Air')->first()->id ?? 1,
            'cooler_id' => \App\Models\Cooler::where('name', 'Deepcool AK400 Air Cooler')->first()->id ?? 1,
        ]);

        // Intel High-End (Pro)
        CustombuiltConfig::create([
            'name' => 'Intel Gaming Config 2: High-End / 1440p Sweet Spot',
            'description' => 'Perfect for 1440p high-refresh gaming.',
            'price' => 75000,
            'image_url' => 'https://images.unsplash.com/photo-1547082299-de196ea013d6?w=800&q=80',
            'platform' => 'Intel',
            'tier' => 'Pro',
            'rating' => rand(40, 50) / 10,
            'review_count' => rand(15, 120),
            'cpu_id' => Cpu::where('name', 'Intel Core Ultra 7 265K (20-Core)')->first()->id ?? 1,
            'gpu_id' => Gpu::where('name', 'NVIDIA GeForce RTX 5070 12GB')->first()->id ?? 1,
            'motherboard_id' => Motherboard::where('name', 'ASUS TUF Gaming Z890-PLUS WIFI')->first()->id ?? 1,
            'ram_id' => Ram::where('name', '32GB (2x16GB) DDR5-7200')->first()->id ?? 1,
            'storage_id' => Storage::where('name', '2TB NVMe PCIe 4.0 SSD')->first()->id ?? 1,
            'power_supply_id' => PowerSupply::where('name', '750W 80+ Gold')->first()->id ?? 1,
            'pc_case_id' => PcCase::where('name', 'Corsair 4000D Airflow')->first()->id ?? 1,
            'cooler_id' => \App\Models\Cooler::where('name', 'Thermalright Peerless Assassin 120')->first()->id ?? 1,
        ]);

        // Intel Enthusiast (Elite)
        CustombuiltConfig::create([
            'name' => 'Intel Gaming Config 3: Enthusiast / 4K Ready',
            'description' => 'Uncompromised 4K performance for power users.',
            'price' => 110000,
            'image_url' => 'https://images.unsplash.com/photo-1587202372775-e229f172b9d7?w=800&q=80',
            'platform' => 'Intel',
            'tier' => 'Elite',
            'rating' => rand(40, 50) / 10,
            'review_count' => rand(15, 120),
            'cpu_id' => Cpu::where('name', 'Intel Core Ultra 7 270K Plus (24-Core)')->first()->id ?? 1,
            'gpu_id' => Gpu::where('name', 'NVIDIA GeForce RTX 5080 16GB')->first()->id ?? 1,
            'motherboard_id' => Motherboard::where('name', 'Gigabyte Z890 AORUS ELITE AX')->first()->id ?? 1,
            'ram_id' => Ram::where('name', '32GB (2x16GB) DDR5-7600')->first()->id ?? 1,
            'storage_id' => Storage::where('name', '2TB NVMe PCIe 5.0 SSD')->first()->id ?? 1,
            'power_supply_id' => PowerSupply::where('name', '850W 80+ Gold (ATX 3.1)')->first()->id ?? 1,
            'pc_case_id' => PcCase::where('name', 'NZXT H7 Flow')->first()->id ?? 1,
            'cooler_id' => \App\Models\Cooler::where('name', 'NZXT Kraken 240 RGB Liquid Cooler')->first()->id ?? 1,
        ]);

        // Intel Ultimate
        CustombuiltConfig::create([
            'name' => 'Intel Gaming Config 4: Ultimate / 4K+ & Creator',
            'description' => 'The absolute pinnacle of gaming and productivity.',
            'price' => 150000,
            'image_url' => 'https://images.unsplash.com/photo-1512756290469-ec264b7fbf87?w=800&q=80',
            'platform' => 'Intel',
            'tier' => 'Ultimate',
            'rating' => rand(40, 50) / 10,
            'review_count' => rand(15, 120),
            'cpu_id' => Cpu::where('name', 'Intel Core Ultra 9 285K (24-Core)')->first()->id ?? 1,
            'gpu_id' => Gpu::where('name', 'NVIDIA GeForce RTX 5090 32GB')->first()->id ?? 1,
            'motherboard_id' => Motherboard::where('name', 'ASUS ROG Maximus Z890 Hero')->first()->id ?? 1,
            'ram_id' => Ram::where('name', '64GB (2x32GB) DDR5-8000 CUDIMM')->first()->id ?? 1,
            'storage_id' => Storage::where('name', '4TB (2x 2TB) NVMe PCIe 5.0 SSD')->first()->id ?? 1,
            'power_supply_id' => PowerSupply::where('name', '1200W 80+ Platinum (ATX 3.1)')->first()->id ?? 1,
            'pc_case_id' => PcCase::where('name', 'Lian Li O11 Dynamic EVO')->first()->id ?? 1,
            'cooler_id' => \App\Models\Cooler::where('name', 'Corsair iCUE Link H150i RGB')->first()->id ?? 1,
        ]);

        // AMD Mainstream
        CustombuiltConfig::create([
            'name' => 'AMD Gaming Config 1: Mainstream / 1080p Performer',
            'description' => 'Solid entry into the AM5 ecosystem for 1080p gaming.',
            'price' => 38000,
            'image_url' => 'https://images.unsplash.com/photo-1587202372775-e229f172b9d7?w=800&q=80',
            'platform' => 'AMD',
            'tier' => 'Mainstream',
            'rating' => rand(40, 50) / 10,
            'review_count' => rand(15, 120),
            'cpu_id' => Cpu::where('name', 'AMD Ryzen 5 9600X')->first()->id ?? 1,
            'gpu_id' => Gpu::where('name', 'NVIDIA GeForce RTX 5060 Ti 16GB')->first()->id ?? 1,
            'motherboard_id' => Motherboard::where('name', 'Gigabyte B850 AORUS ELITE WIFI7')->first()->id ?? 1,
            'ram_id' => Ram::where('name', '32GB (2x16GB) DDR5-6000')->first()->id ?? 1,
            'storage_id' => Storage::where('name', '1TB NVMe PCIe 4.0 SSD')->first()->id ?? 1,
            'power_supply_id' => PowerSupply::where('name', '650W 80+ Gold')->first()->id ?? 1,
            'pc_case_id' => PcCase::where('name', 'Corsair 4000D Airflow')->first()->id ?? 1,
            'cooler_id' => \App\Models\Cooler::where('name', 'Deepcool AK400 Air Cooler')->first()->id ?? 1,
        ]);

        // AMD High-End (Pro)
        CustombuiltConfig::create([
            'name' => 'AMD Gaming Config 2: High-End / 1440p Sweet Spot',
            'description' => 'The sweet spot for 1440p AMD gaming.',
            'price' => 78000,
            'image_url' => 'https://images.unsplash.com/photo-1547082299-de196ea013d6?w=800&q=80',
            'platform' => 'AMD',
            'tier' => 'Pro',
            'rating' => rand(40, 50) / 10,
            'review_count' => rand(15, 120),
            'cpu_id' => Cpu::where('name', 'AMD Ryzen 7 9700X')->first()->id ?? 1,
            'gpu_id' => Gpu::where('name', 'AMD Radeon RX 9070 XT 16GB')->first()->id ?? 1,
            'motherboard_id' => Motherboard::where('name', 'MSI MAG B850 TOMAHAWK WIFI')->first()->id ?? 1,
            'ram_id' => Ram::where('name', '32GB (2x16GB) DDR5-6000 CL30')->first()->id ?? 1,
            'storage_id' => Storage::where('name', '2TB NVMe PCIe 4.0 SSD')->first()->id ?? 1,
            'power_supply_id' => PowerSupply::where('name', '750W 80+ Gold')->first()->id ?? 1,
            'pc_case_id' => PcCase::where('name', 'NZXT H5 Flow')->first()->id ?? 1,
            'cooler_id' => \App\Models\Cooler::where('name', 'Thermalright Peerless Assassin 120')->first()->id ?? 1,
        ]);

        // AMD Enthusiast (Elite)
        CustombuiltConfig::create([
            'name' => 'AMD Gaming Config 3: Enthusiast / 4K Ready',
            'description' => 'Amazing 4K performance for AMD enthusiasts.',
            'price' => 115000,
            'image_url' => 'https://images.unsplash.com/photo-1547082299-de196ea013d6?w=800&q=80',
            'platform' => 'AMD',
            'tier' => 'Elite',
            'rating' => rand(40, 50) / 10,
            'review_count' => rand(15, 120),
            'cpu_id' => Cpu::where('name', 'AMD Ryzen 7 9800X3D')->first()->id ?? 1,
            'gpu_id' => Gpu::where('name', 'NVIDIA GeForce RTX 5080 16GB')->first()->id ?? 1,
            'motherboard_id' => Motherboard::where('name', 'ASUS ROG Strix X870-A Gaming WiFi')->first()->id ?? 1,
            'ram_id' => Ram::where('name', '32GB (2x16GB) DDR5-6400 CL32')->first()->id ?? 1,
            'storage_id' => Storage::where('name', '2TB NVMe PCIe 5.0 SSD')->first()->id ?? 1,
            'power_supply_id' => PowerSupply::where('name', '850W 80+ Gold (ATX 3.1)')->first()->id ?? 1,
            'pc_case_id' => PcCase::where('name', 'Lian Li Lancool 216')->first()->id ?? 1,
            'cooler_id' => \App\Models\Cooler::where('name', 'NZXT Kraken 240 RGB Liquid Cooler')->first()->id ?? 1,
        ]);

        // AMD Ultimate
        CustombuiltConfig::create([
            'name' => 'AMD Gaming Config 4: Ultimate / 4K+ & Creator',
            'description' => 'The ultimate gaming and creator king.',
            'price' => 160000,
            'image_url' => 'https://images.unsplash.com/photo-1512756290469-ec264b7fbf87?w=800&q=80',
            'platform' => 'AMD',
            'tier' => 'Ultimate',
            'rating' => rand(40, 50) / 10,
            'review_count' => rand(15, 120),
            'cpu_id' => Cpu::where('name', 'AMD Ryzen 9 9950X3D2 (Dual Edition)')->first()->id ?? 1,
            'gpu_id' => Gpu::where('name', 'NVIDIA GeForce RTX 5090 32GB')->first()->id ?? 1,
            'motherboard_id' => Motherboard::where('name', 'Gigabyte X870E AORUS MASTER X3D ICE')->first()->id ?? 1,
            'ram_id' => Ram::where('name', '64GB (2x32GB) DDR5-8200 (AMD EXPO)')->first()->id ?? 1,
            'storage_id' => Storage::where('name', '4TB (2x 2TB) NVMe PCIe 5.0 SSD')->first()->id ?? 1,
            'power_supply_id' => PowerSupply::where('name', '1200W 80+ Platinum (ATX 3.1)')->first()->id ?? 1,
            'pc_case_id' => PcCase::where('name', 'Lian Li O11 Dynamic EVO')->first()->id ?? 1,
            'cooler_id' => \App\Models\Cooler::where('name', 'Arctic Liquid Freezer III 360')->first()->id ?? 1,
        ]);
    }
}