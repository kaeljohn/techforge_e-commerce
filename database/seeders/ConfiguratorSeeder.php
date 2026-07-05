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
        // CPUs
        Cpu::create(['name' => 'AMD Ryzen 7 7800X3D', 'price' => 20000, 'socket' => 'AM5', 'tdp' => 120]);
        Cpu::create(['name' => 'AMD Ryzen 5 7600X', 'price' => 14000, 'socket' => 'AM5', 'tdp' => 105]);
        Cpu::create(['name' => 'Intel Core Ultra 9 285K', 'price' => 35000, 'socket' => 'LGA 1851', 'tdp' => 253]); // LGA 1851
        Cpu::create(['name' => 'Intel Core i7-14700K', 'price' => 25000, 'socket' => 'LGA 1700', 'tdp' => 253]);

        // Motherboards (Form factors: 4: E-ATX, 3: ATX, 2: Micro-ATX, 1: Mini-ITX)
        Motherboard::create(['name' => 'ASUS ROG Crosshair X670E Hero', 'price' => 35000, 'socket' => 'AM5', 'form_factor' => 3, 'supported_ram_gen' => 'DDR5']); // AM5
        Motherboard::create(['name' => 'MSI MAG B650 Tomahawk', 'price' => 12000, 'socket' => 'AM5', 'form_factor' => 3, 'supported_ram_gen' => 'DDR5']); // AM5
        Motherboard::create(['name' => 'Gigabyte Z890 AORUS MASTER', 'price' => 30000, 'socket' => 'LGA 1851', 'form_factor' => 4, 'supported_ram_gen' => 'DDR5']); // LGA 1851
        Motherboard::create(['name' => 'ASUS ROG Strix Z790-E', 'price' => 28000, 'socket' => 'LGA 1700', 'form_factor' => 3, 'supported_ram_gen' => 'DDR5']); // LGA 1700
        Motherboard::create(['name' => 'MSI PRO H610M-G', 'price' => 5000, 'socket' => 'LGA 1700', 'form_factor' => 2, 'supported_ram_gen' => 'DDR4']); // DDR4

        // RAM
        Ram::create(['name' => 'G.Skill Trident Z5 RGB 32GB (2x16GB)', 'price' => 8000, 'generation' => 'DDR5', 'capacity' => 32, 'speed' => 6000]);
        Ram::create(['name' => 'Corsair Vengeance 32GB (2x16GB)', 'price' => 7000, 'generation' => 'DDR5', 'capacity' => 32, 'speed' => 5600]);
        Ram::create(['name' => 'Corsair Vengeance LPX 16GB (2x8GB)', 'price' => 2500, 'generation' => 'DDR4', 'capacity' => 16, 'speed' => 3200]);

        // GPUs
        Gpu::create(['name' => 'NVIDIA GeForce RTX 4090', 'price' => 110000, 'tdp' => 450, 'length_mm' => 340]);
        Gpu::create(['name' => 'NVIDIA GeForce RTX 4070 Ti SUPER', 'price' => 50000, 'tdp' => 285, 'length_mm' => 305]);
        Gpu::create(['name' => 'AMD Radeon RX 7900 XTX', 'price' => 60000, 'tdp' => 355, 'length_mm' => 287]);

        // Power Supplies
        PowerSupply::create(['name' => 'Corsair RM1000x', 'price' => 10000, 'wattage' => 1000, 'form_factor' => 'ATX']);
        PowerSupply::create(['name' => 'Seasonic Focus GX-850', 'price' => 8000, 'wattage' => 850, 'form_factor' => 'ATX']);
        PowerSupply::create(['name' => 'Corsair SF750', 'price' => 9000, 'wattage' => 750, 'form_factor' => 'SFX']);

        // PC Cases (Form factors: 4: E-ATX, 3: ATX, 2: Micro-ATX, 1: Mini-ITX)
        PcCase::create(['name' => 'Lian Li O11 Dynamic EVO', 'price' => 9500, 'max_mobo_size' => 4, 'max_gpu_length' => 426]);
        PcCase::create(['name' => 'NZXT H5 Flow', 'price' => 5500, 'max_mobo_size' => 3, 'max_gpu_length' => 365]);
        PcCase::create(['name' => 'Cooler Master NR200P', 'price' => 5000, 'max_mobo_size' => 1, 'max_gpu_length' => 330]);
    }
}
