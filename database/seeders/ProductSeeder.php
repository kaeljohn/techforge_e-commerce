<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'TechForge Obsidian X',
                'category' => 'Prebuilt Desktops',
                'brand' => 'TechForge Forge',
                'processor' => 'AMD Ryzen 7',
                'specs' => 'RYZEN 7 7800X3D | RTX 4080 SUPER',
                'price' => 145000,
                'rating' => 4.9,
                'image_url' => 'https://images.unsplash.com/photo-1587202372634-32705e3bf49c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'badge' => 'BEST SELLER',
                'is_sold_out' => false,
            ],
            [
                'name' => 'TechForge Quantum',
                'category' => 'Prebuilt Desktops',
                'brand' => 'TechForge Forge',
                'processor' => 'Intel Core i5',
                'specs' => 'CORE I5-13600K | RTX 4070 TI',
                'price' => 112500,
                'rating' => 4.7,
                'image_url' => 'https://images.unsplash.com/photo-1547082299-de196ea013d6?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'badge' => null,
                'is_sold_out' => false,
            ],
            [
                'name' => 'TechForge Zenith Pro',
                'category' => 'Prebuilt Desktops',
                'brand' => 'TechForge Forge',
                'processor' => 'Intel Core i9',
                'specs' => 'CORE I9-14900K | RTX 4090',
                'price' => 235000,
                'rating' => 5.0,
                'image_url' => 'https://images.unsplash.com/photo-1591488320449-011701bb6704?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'badge' => 'NEW ARRIVAL',
                'is_sold_out' => false,
            ],
            [
                'name' => 'ROG Strix G15',
                'category' => 'Prebuilt Desktops',
                'brand' => 'ASUS ROG',
                'processor' => 'AMD Ryzen 9',
                'specs' => 'RYZEN 9 7900X | RTX 4080',
                'price' => 180000,
                'rating' => 4.8,
                'image_url' => 'https://images.unsplash.com/photo-1587202372775-e229f172b9d7?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'badge' => 'SAVE 10%',
                'is_sold_out' => false,
            ],
            [
                'name' => 'Lenovo Legion Tower 5i',
                'category' => 'Prebuilt Desktops',
                'brand' => 'Lenovo Legion',
                'processor' => 'Intel Core i7',
                'specs' => 'CORE I7-13700F | RTX 4060 Ti',
                'price' => 85000,
                'rating' => 4.6,
                'image_url' => 'https://images.unsplash.com/photo-1624705002806-5d72df19c3ad?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'badge' => null,
                'is_sold_out' => true,
            ],
            [
                'name' => 'MSI Aegis RS',
                'category' => 'Prebuilt Desktops',
                'brand' => 'MSI',
                'processor' => 'Intel Core i7',
                'specs' => 'CORE I7-13700KF | RTX 4070',
                'price' => 125000,
                'rating' => 4.7,
                'image_url' => 'https://images.unsplash.com/photo-1589149098258-3e9102cd63d3?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'badge' => 'LOW STOCK',
                'is_sold_out' => true,
            ]
        ];

        foreach ($products as $product) {
            \App\Models\Product::create($product);
        }
    }
}
