<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComponentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $components = [
            // Processors (CPUs)
            ['type' => 'Processor', 'name' => 'AMD Ryzen 7 7800X3D', 'price' => 20000, 'stock' => 10],
            ['type' => 'Processor', 'name' => 'AMD Ryzen 9 7900X', 'price' => 25000, 'stock' => 5],
            ['type' => 'Processor', 'name' => 'Intel Core i7-13700F', 'price' => 18000, 'stock' => 12],
            ['type' => 'Processor', 'name' => 'Intel Core i5-13600K', 'price' => 15000, 'stock' => 8],
            ['type' => 'Processor', 'name' => 'Intel Core i9-14900K', 'price' => 35000, 'stock' => 3],
            ['type' => 'Processor', 'name' => 'AMD Ryzen 5 7600X', 'price' => 12000, 'stock' => 15],

            // Video Cards (GPUs)
            ['type' => 'Video Card', 'name' => 'NVIDIA RTX 4080 SUPER 16GB', 'price' => 60000, 'stock' => 5],
            ['type' => 'Video Card', 'name' => 'NVIDIA RTX 4080 16GB', 'price' => 55000, 'stock' => 2],
            ['type' => 'Video Card', 'name' => 'NVIDIA RTX 4060 Ti 8GB', 'price' => 25000, 'stock' => 20],
            ['type' => 'Video Card', 'name' => 'NVIDIA RTX 4070 Ti 12GB', 'price' => 40000, 'stock' => 8],
            ['type' => 'Video Card', 'name' => 'NVIDIA RTX 4090 24GB', 'price' => 110000, 'stock' => 1],
            ['type' => 'Video Card', 'name' => 'NVIDIA RTX 4060 8GB', 'price' => 18000, 'stock' => 25],

            // Memory (RAM)
            ['type' => 'Memory', 'name' => '32GB DDR5-6000MHz', 'price' => 8000, 'stock' => 30],
            ['type' => 'Memory', 'name' => '64GB DDR5-5600MHz', 'price' => 15000, 'stock' => 10],
            ['type' => 'Memory', 'name' => '16GB DDR5-5200MHz', 'price' => 4500, 'stock' => 40],
            ['type' => 'Memory', 'name' => '64GB DDR5-6400MHz', 'price' => 18000, 'stock' => 5],

            // Storage
            ['type' => 'Storage', 'name' => '2TB NVMe M.2 SSD', 'price' => 7000, 'stock' => 25],
            ['type' => 'Storage', 'name' => '2TB Gen4 NVMe SSD', 'price' => 8500, 'stock' => 15],
            ['type' => 'Storage', 'name' => '1TB NVMe SSD', 'price' => 3500, 'stock' => 50],
            ['type' => 'Storage', 'name' => '4TB Gen4 NVMe M.2', 'price' => 16000, 'stock' => 5],
            ['type' => 'Storage', 'name' => '1TB NVMe M.2', 'price' => 3800, 'stock' => 45],
        ];

        foreach ($components as $component) {
            \App\Models\Component::create($component);
        }
    }
}
