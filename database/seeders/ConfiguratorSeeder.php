<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cpu;
use App\Models\Motherboard;
use App\Models\Ram;
use App\Models\Gpu;
use App\Models\PowerSupply;
use App\Models\PcCase;

class ConfiguratorSeeder extends Seeder
{
    public function run(): void
    {
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        Cpu::truncate();
        Motherboard::truncate();
        Ram::truncate();
        Gpu::truncate();
        PowerSupply::truncate();
        PcCase::truncate();
        \App\Models\Storage::truncate();
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();
        // CPUs
        // AMD
        Cpu::create(['name' => 'AMD Ryzen 5 7600', 'price' => 12500, 'socket' => 'AM5', 'tdp' => 65]);
        Cpu::create(['name' => 'AMD Ryzen 5 7600X', 'price' => 14000, 'socket' => 'AM5', 'tdp' => 105]);
        Cpu::create(['name' => 'AMD Ryzen 7 7800X3D', 'price' => 22000, 'socket' => 'AM5', 'tdp' => 120]);
        Cpu::create(['name' => 'AMD Ryzen 9 7900X', 'price' => 26000, 'socket' => 'AM5', 'tdp' => 170]);
        Cpu::create(['name' => 'AMD Ryzen 9 7950X3D', 'price' => 38000, 'socket' => 'AM5', 'tdp' => 120]);
        
        // Intel
        Cpu::create(['name' => 'Intel Core i5-13400F', 'price' => 11500, 'socket' => 'LGA 1700', 'tdp' => 65]);
        Cpu::create(['name' => 'Intel Core i5-13600K', 'price' => 17500, 'socket' => 'LGA 1700', 'tdp' => 125]);
        Cpu::create(['name' => 'Intel Core i7-14700K', 'price' => 25000, 'socket' => 'LGA 1700', 'tdp' => 253]);
        Cpu::create(['name' => 'Intel Core i9-14900K', 'price' => 35000, 'socket' => 'LGA 1700', 'tdp' => 253]);
        Cpu::create(['name' => 'Intel Core Ultra 9 285K', 'price' => 36500, 'socket' => 'LGA 1851', 'tdp' => 253]);

        // Motherboards (Form factors: 4: E-ATX, 3: ATX, 2: Micro-ATX, 1: Mini-ITX)
        // AMD Motherboards
        Motherboard::create(['name' => 'ASRock A620M Pro RS', 'price' => 6500, 'socket' => 'AM5', 'form_factor' => 2, 'supported_ram_gen' => 'DDR5']);
        Motherboard::create(['name' => 'MSI MAG B650 TOMAHAWK WIFI', 'price' => 12500, 'socket' => 'AM5', 'form_factor' => 3, 'supported_ram_gen' => 'DDR5']);
        Motherboard::create(['name' => 'Gigabyte B650 AORUS ELITE AX', 'price' => 13500, 'socket' => 'AM5', 'form_factor' => 3, 'supported_ram_gen' => 'DDR5']);
        Motherboard::create(['name' => 'ASUS ROG Crosshair X670E Hero', 'price' => 38000, 'socket' => 'AM5', 'form_factor' => 3, 'supported_ram_gen' => 'DDR5']);
        
        // Intel Motherboards
        Motherboard::create(['name' => 'MSI PRO B760M-A WIFI', 'price' => 9500, 'socket' => 'LGA 1700', 'form_factor' => 2, 'supported_ram_gen' => 'DDR5']);
        Motherboard::create(['name' => 'ASUS TUF GAMING Z790-PLUS WIFI', 'price' => 16500, 'socket' => 'LGA 1700', 'form_factor' => 3, 'supported_ram_gen' => 'DDR5']);
        Motherboard::create(['name' => 'Gigabyte Z790 AORUS MASTER', 'price' => 32000, 'socket' => 'LGA 1700', 'form_factor' => 4, 'supported_ram_gen' => 'DDR5']);
        Motherboard::create(['name' => 'ASUS ROG Maximus Z890 Hero', 'price' => 42000, 'socket' => 'LGA 1851', 'form_factor' => 3, 'supported_ram_gen' => 'DDR5']);

        // RAM
        Ram::create(['name' => 'Corsair Vengeance LPX 16GB (2x8GB)', 'price' => 2500, 'generation' => 'DDR4', 'capacity' => 16, 'speed' => 3200]);
        Ram::create(['name' => 'Kingston FURY Beast 16GB (2x8GB)', 'price' => 3800, 'generation' => 'DDR5', 'capacity' => 16, 'speed' => 5200]);
        Ram::create(['name' => 'Corsair Vengeance 32GB (2x16GB)', 'price' => 6500, 'generation' => 'DDR5', 'capacity' => 32, 'speed' => 5600]);
        Ram::create(['name' => 'G.Skill Trident Z5 Neo RGB 32GB (2x16GB)', 'price' => 8500, 'generation' => 'DDR5', 'capacity' => 32, 'speed' => 6000]);
        Ram::create(['name' => 'G.Skill Trident Z5 RGB 64GB (2x32GB)', 'price' => 16500, 'generation' => 'DDR5', 'capacity' => 64, 'speed' => 6400]);

        // GPUs
        Gpu::create(['name' => 'NVIDIA GeForce RTX 4060', 'price' => 18500, 'tdp' => 115, 'length_mm' => 240]);
        Gpu::create(['name' => 'NVIDIA GeForce RTX 4060 Ti', 'price' => 25500, 'tdp' => 160, 'length_mm' => 260]);
        Gpu::create(['name' => 'NVIDIA GeForce RTX 4070 SUPER', 'price' => 38500, 'tdp' => 220, 'length_mm' => 280]);
        Gpu::create(['name' => 'NVIDIA GeForce RTX 4070 Ti SUPER', 'price' => 51000, 'tdp' => 285, 'length_mm' => 305]);
        Gpu::create(['name' => 'NVIDIA GeForce RTX 4080 SUPER', 'price' => 65000, 'tdp' => 320, 'length_mm' => 310]);
        Gpu::create(['name' => 'NVIDIA GeForce RTX 4090', 'price' => 115000, 'tdp' => 450, 'length_mm' => 340]);
        Gpu::create(['name' => 'AMD Radeon RX 7800 XT', 'price' => 32000, 'tdp' => 263, 'length_mm' => 280]);
        Gpu::create(['name' => 'AMD Radeon RX 7900 XTX', 'price' => 62000, 'tdp' => 355, 'length_mm' => 287]);

        // Power Supplies
        PowerSupply::create(['name' => 'Corsair CV650', 'price' => 3500, 'wattage' => 650, 'form_factor' => 'ATX']);
        PowerSupply::create(['name' => 'Seasonic Focus GX-750', 'price' => 6500, 'wattage' => 750, 'form_factor' => 'ATX']);
        PowerSupply::create(['name' => 'Corsair RM850e', 'price' => 7800, 'wattage' => 850, 'form_factor' => 'ATX']);
        PowerSupply::create(['name' => 'Corsair RM1000x', 'price' => 11500, 'wattage' => 1000, 'form_factor' => 'ATX']);
        PowerSupply::create(['name' => 'Seasonic Vertex GX-1200', 'price' => 16500, 'wattage' => 1200, 'form_factor' => 'ATX']);
        PowerSupply::create(['name' => 'Corsair SF750', 'price' => 9500, 'wattage' => 750, 'form_factor' => 'SFX']);

        // PC Cases
        PcCase::create(['name' => 'Deepcool CH560 Digital', 'price' => 5500, 'max_mobo_size' => 4, 'max_gpu_length' => 380]);
        PcCase::create(['name' => 'NZXT H5 Flow', 'price' => 6200, 'max_mobo_size' => 3, 'max_gpu_length' => 365]);
        PcCase::create(['name' => 'NZXT H9 Flow', 'price' => 9500, 'max_mobo_size' => 3, 'max_gpu_length' => 435]);
        PcCase::create(['name' => 'Lian Li O11 Dynamic EVO', 'price' => 9800, 'max_mobo_size' => 4, 'max_gpu_length' => 426]);
        PcCase::create(['name' => 'Fractal Design North', 'price' => 8500, 'max_mobo_size' => 3, 'max_gpu_length' => 355]);
        PcCase::create(['name' => 'Cooler Master NR200P', 'price' => 5200, 'max_mobo_size' => 1, 'max_gpu_length' => 330]);
        
        // Storage
        \App\Models\Storage::create(['name' => 'Kingston NV2 1TB', 'type' => 'NVMe M.2', 'capacity' => 1000, 'price' => 3200]);
        \App\Models\Storage::create(['name' => 'Crucial P3 Plus 1TB', 'type' => 'NVMe Gen4', 'capacity' => 1000, 'price' => 3800]);
        \App\Models\Storage::create(['name' => 'Samsung 980 PRO 1TB', 'type' => 'NVMe Gen4', 'capacity' => 1000, 'price' => 6500]);
        \App\Models\Storage::create(['name' => 'Samsung 990 PRO 2TB', 'type' => 'NVMe Gen4', 'capacity' => 2000, 'price' => 12500]);
        \App\Models\Storage::create(['name' => 'WD Black SN850X 4TB', 'type' => 'NVMe Gen4', 'capacity' => 4000, 'price' => 21000]);
    }
}
