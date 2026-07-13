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
            'name' => 'Intel© Mainstream Gaming PC Configurator',
            'description' => 'A great starting point for 1080p gaming.',
            'price' => 35000,
            'image_url' => 'https://images.unsplash.com/photo-1587202372775-e229f172b9d7?w=800&q=80',
            'platform' => 'Intel',
            'tier' => 'Mainstream',
            'rating' => rand(40, 50) / 10,
            'review_count' => rand(15, 120),
            'cpu_id' => Cpu::where('name', 'like', '%i5%')->first()->id ?? 1,
            'gpu_id' => Gpu::where('name', 'like', '%RTX 3060%')->first()->id ?? 1,
            'motherboard_id' => Motherboard::where('name', 'like', '%Z790%')->first()->id ?? 1,
            'ram_id' => Ram::where('name', 'like', '%16GB%')->first()->id ?? 1,
            'storage_id' => Storage::where('name', 'like', '%1TB%')->first()->id ?? 1,
            'power_supply_id' => PowerSupply::where('name', 'like', '%650%')->first()->id ?? 1,
            'pc_case_id' => PcCase::first()->id ?? 1,
        ]);

        // Intel Pro
        CustombuiltConfig::create([
            'name' => 'Intel© Pro Gaming PC Configurator',
            'description' => 'Perfect for 1440p high-refresh gaming.',
            'price' => 75000,
            'image_url' => 'https://images.unsplash.com/photo-1547082299-de196ea013d6?w=800&q=80',
            'platform' => 'Intel',
            'tier' => 'Pro',
            'rating' => rand(40, 50) / 10,
            'review_count' => rand(15, 120),
            'cpu_id' => Cpu::where('name', 'like', '%i7%')->first()->id ?? 2,
            'gpu_id' => Gpu::where('name', 'like', '%RTX 4070%')->first()->id ?? 2,
            'motherboard_id' => Motherboard::where('name', 'like', '%Z790%')->first()->id ?? 1,
            'ram_id' => Ram::where('name', 'like', '%32GB%')->first()->id ?? 2,
            'storage_id' => Storage::where('name', 'like', '%2TB%')->first()->id ?? 2,
            'power_supply_id' => PowerSupply::where('name', 'like', '%850%')->first()->id ?? 2,
            'pc_case_id' => PcCase::skip(1)->first()->id ?? 2,
        ]);

        // Intel Elite
        CustombuiltConfig::create([
            'name' => 'Intel© Elite Gaming PC Configurator',
            'description' => 'Uncompromised 4K performance for power users.',
            'price' => 110000,
            'image_url' => 'https://images.unsplash.com/photo-1587202372775-e229f172b9d7?w=800&q=80',
            'platform' => 'Intel',
            'tier' => 'Elite',
            'rating' => rand(40, 50) / 10,
            'review_count' => rand(15, 120),
            'cpu_id' => Cpu::where('name', 'like', '%i7%')->skip(1)->first()->id ?? 2,
            'gpu_id' => Gpu::where('name', 'like', '%RTX 4080%')->first()->id ?? 2,
            'motherboard_id' => Motherboard::where('name', 'like', '%Z790%')->first()->id ?? 1,
            'ram_id' => Ram::where('name', 'like', '%32GB%')->first()->id ?? 2,
            'storage_id' => Storage::where('name', 'like', '%2TB%')->first()->id ?? 2,
            'power_supply_id' => PowerSupply::where('name', 'like', '%850%')->first()->id ?? 2,
            'pc_case_id' => PcCase::skip(1)->first()->id ?? 2,
        ]);

        // Intel Ultimate
        CustombuiltConfig::create([
            'name' => 'Intel© Ultimate Gaming PC Configurator',
            'description' => 'The absolute pinnacle of gaming and productivity.',
            'price' => 150000,
            'image_url' => 'https://images.unsplash.com/photo-1512756290469-ec264b7fbf87?w=800&q=80',
            'platform' => 'Intel',
            'tier' => 'Ultimate',
            'rating' => rand(40, 50) / 10,
            'review_count' => rand(15, 120),
            'cpu_id' => Cpu::where('name', 'like', '%i9%')->first()->id ?? 3,
            'gpu_id' => Gpu::where('name', 'like', '%RTX 4090%')->first()->id ?? 3,
            'motherboard_id' => Motherboard::where('name', 'like', '%Z790%')->first()->id ?? 1,
            'ram_id' => Ram::where('name', 'like', '%64GB%')->first()->id ?? 3,
            'storage_id' => Storage::where('name', 'like', '%4TB%')->first()->id ?? 3,
            'power_supply_id' => PowerSupply::where('name', 'like', '%1000%')->first()->id ?? 3,
            'pc_case_id' => PcCase::skip(2)->first()->id ?? 3,
        ]);

        // AMD Mainstream
        CustombuiltConfig::create([
            'name' => 'AMD Ryzen™ Mainstream Gaming PC Configurator',
            'description' => 'Solid entry into the AM5 ecosystem.',
            'price' => 38000,
            'image_url' => 'https://images.unsplash.com/photo-1587202372775-e229f172b9d7?w=800&q=80',
            'platform' => 'AMD',
            'tier' => 'Mainstream',
            'rating' => 0, // Unrated build
            'review_count' => 0,
            'cpu_id' => Cpu::where('name', 'like', '%Ryzen 5%')->first()->id ?? 4,
            'gpu_id' => Gpu::where('name', 'like', '%RTX 3060%')->first()->id ?? 1,
            'motherboard_id' => Motherboard::where('name', 'like', '%X670%')->first()->id ?? 2,
            'ram_id' => Ram::where('name', 'like', '%16GB%')->first()->id ?? 1,
            'storage_id' => Storage::where('name', 'like', '%1TB%')->first()->id ?? 1,
            'power_supply_id' => PowerSupply::where('name', 'like', '%650%')->first()->id ?? 1,
            'pc_case_id' => PcCase::first()->id ?? 1,
        ]);

        // AMD Pro
        CustombuiltConfig::create([
            'name' => 'AMD Ryzen™ Pro Gaming PC Configurator',
            'description' => 'The sweet spot for AMD gaming.',
            'price' => 78000,
            'image_url' => 'https://images.unsplash.com/photo-1547082299-de196ea013d6?w=800&q=80',
            'platform' => 'AMD',
            'tier' => 'Pro',
            'rating' => rand(40, 50) / 10,
            'review_count' => rand(15, 120),
            'cpu_id' => Cpu::where('name', 'like', '%Ryzen 7 9700X%')->first()->id ?? 5,
            'gpu_id' => Gpu::where('name', 'like', '%RTX 4070%')->first()->id ?? 2,
            'motherboard_id' => Motherboard::where('name', 'like', '%X670%')->first()->id ?? 2,
            'ram_id' => Ram::where('name', 'like', '%32GB%')->first()->id ?? 2,
            'storage_id' => Storage::where('name', 'like', '%2TB%')->first()->id ?? 2,
            'power_supply_id' => PowerSupply::where('name', 'like', '%850%')->first()->id ?? 2,
            'pc_case_id' => PcCase::skip(1)->first()->id ?? 2,
        ]);

        // AMD Elite
        CustombuiltConfig::create([
            'name' => 'AMD Ryzen™ Elite Gaming PC Configurator',
            'description' => 'Amazing 4K performance for AMD enthusiasts.',
            'price' => 115000,
            'image_url' => 'https://images.unsplash.com/photo-1547082299-de196ea013d6?w=800&q=80',
            'platform' => 'AMD',
            'tier' => 'Elite',
            'rating' => rand(40, 50) / 10,
            'review_count' => rand(15, 120),
            'cpu_id' => Cpu::where('name', 'like', '%Ryzen 7 9700X%')->skip(1)->first()->id ?? 5,
            'gpu_id' => Gpu::where('name', 'like', '%RTX 4080%')->first()->id ?? 2,
            'motherboard_id' => Motherboard::where('name', 'like', '%X670%')->first()->id ?? 2,
            'ram_id' => Ram::where('name', 'like', '%32GB%')->first()->id ?? 2,
            'storage_id' => Storage::where('name', 'like', '%2TB%')->first()->id ?? 2,
            'power_supply_id' => PowerSupply::where('name', 'like', '%850%')->first()->id ?? 2,
            'pc_case_id' => PcCase::skip(1)->first()->id ?? 2,
        ]);

        // AMD Ultimate
        CustombuiltConfig::create([
            'name' => 'AMD Ryzen™ Ultimate Gaming PC Configurator',
            'description' => 'The ultimate gaming king.',
            'price' => 160000,
            'image_url' => 'https://images.unsplash.com/photo-1512756290469-ec264b7fbf87?w=800&q=80',
            'platform' => 'AMD',
            'tier' => 'Ultimate',
            'rating' => rand(40, 50) / 10,
            'review_count' => rand(15, 120),
            'cpu_id' => Cpu::where('name', 'like', '%Ryzen 7 9800X3D%')->first()->id ?? 6,
            'gpu_id' => Gpu::where('name', 'like', '%RTX 4090%')->first()->id ?? 3,
            'motherboard_id' => Motherboard::where('name', 'like', '%X670%')->first()->id ?? 2,
            'ram_id' => Ram::where('name', 'like', '%64GB%')->first()->id ?? 3,
            'storage_id' => Storage::where('name', 'like', '%4TB%')->first()->id ?? 3,
            'power_supply_id' => PowerSupply::where('name', 'like', '%1000%')->first()->id ?? 3,
            'pc_case_id' => PcCase::skip(2)->first()->id ?? 3,
        ]);
    }
}