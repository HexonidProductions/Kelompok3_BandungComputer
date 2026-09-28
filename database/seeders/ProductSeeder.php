<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'product_code' => 'LPT-ROG14',
            'product_name' => 'ASUS ROG Zephyrus G14 Black Edition',
            'category_id' => Category::where('category_name', 'Laptop')->value('id'),
            'image' => 'products/laptop-rog14.jpg',
            'description' => 'Laptop gaming 14 inci ultraportable ditenagai AMD Ryzen 9 dan NVIDIA GeForce RTX, dilengkapi layar ROG Nebula Display serta desain Eclipse Gray yang ringkas dan elegan.',
            'buy_price' => '21000000',
            'sell_price' => '24500000',
            'stock' => '12',
            'status' => 'Available'
        ]);

        Product::create([
            'product_code' => 'LPT-ROG13',
            'product_name' => 'ASUS ROG Zephyrus G13 Black Edition',
            'category_id' => Category::where('category_name', 'Laptop')->value('id'),
            'image' => 'products/laptop-rog14.jpg',
            'description' => 'Laptop gaming 14 inci ultraportable ditenagai AMD Ryzen 9 dan NVIDIA GeForce RTX, dilengkapi layar ROG Nebula Display serta desain Eclipse Gray yang ringkas dan elegan.',
            'buy_price' => '21000000',
            'sell_price' => '24500000',
            'stock' => '10',
            'status' => 'Available'
        ]);
    }
}
