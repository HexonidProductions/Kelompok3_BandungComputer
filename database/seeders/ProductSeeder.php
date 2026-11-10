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
        $catLaptop = Category::firstOrCreate(['category_name' => 'Laptop'])->id;
        $catGaming = Category::firstOrCreate(['category_name' => 'Gaming'])->id;
        $catAksesoris = Category::firstOrCreate(['category_name' => 'Aksesoris'])->id;

        Product::firstOrCreate(
            ['product_code' => 'LPT-ROG14'],
            [
                'product_name' => 'ASUS ROG Zephyrus G14 Black Edition',
                'category_id' => $catLaptop,
                'image' => 'products/laptop-rog14.jpg',
                'description' => 'Laptop gaming 14 inci ultraportable ditenagai AMD Ryzen 9 dan NVIDIA GeForce RTX, dilengkapi layar ROG Nebula Display serta desain Eclipse Gray yang ringkas dan elegan.',
                'buy_price' => 21000000,
                'sell_price' => 24500000,
                'stock' => 12,
                'status' => 'Available'
            ]
        );

        Product::firstOrCreate(
            ['product_code' => 'LPT-ROG13'],
            [
                'product_name' => 'ASUS ROG Zephyrus G13 Black Edition',
                'category_id' => $catLaptop,
                'image' => 'products/laptop-rog14.jpg',
                'description' => 'Laptop gaming 14 inci ultraportable ditenagai AMD Ryzen 9 dan NVIDIA GeForce RTX, dilengkapi layar ROG Nebula Display serta desain Eclipse Gray yang ringkas dan elegan.',
                'buy_price' => 21000000,
                'sell_price' => 24500000,
                'stock' => 10,
                'status' => 'Available'
            ]
        );

        // 4 Produk Terbaru Homepage
        Product::updateOrCreate(
            ['product_code' => 'MOU-GLR-O'],
            [
                'product_name' => 'Glorious Model O Wireless',
                'category_id' => $catAksesoris,
                'image' => 'images/produkterbaru/Gloriousmodelserieso.png',
                'description' => 'Mouse gaming wireless ultra-ringan dengan sensor BAMF mutakhir, honeycomb shell, dan latensi sangat rendah untuk performa gaming kompetitif.',
                'buy_price' => 1400000,
                'sell_price' => 6622160,
                'stock' => 20,
                'status' => 'Available',
                'created_at' => now()->subMinutes(3),
            ]
        );

        Product::updateOrCreate(
            ['product_code' => 'LPT-ASUS-A15'],
            [
                'product_name' => 'ASUS TUF A15',
                'category_id' => $catLaptop,
                'image' => 'images/produkterbaru/AsusTufA15.png',
                'description' => 'Laptop gaming bertenaga dengan durabilitas standar militer TUF, didukung prosesor AMD Ryzen dan kartu grafis NVIDIA RTX untuk performa gaming terbaik.',
                'buy_price' => 14000000,
                'sell_price' => 16000000,
                'stock' => 15,
                'status' => 'Available',
                'created_at' => now()->subMinutes(2),
            ]
        );

        Product::updateOrCreate(
            ['product_code' => 'LPT-MBP16'],
            [
                'product_name' => 'Macbook Pro 16',
                'category_id' => $catLaptop,
                'image' => 'images/produkterbaru/Macbook_Pro.png',
                'description' => 'Laptop workstation profesional dengan layar Liquid Retina XDR 16 inci dan performa chip Apple Silicon mutakhir untuk multitasking tingkat tinggi.',
                'buy_price' => 49000000,
                'sell_price' => 54072000,
                'stock' => 8,
                'status' => 'Available',
                'created_at' => now()->subMinutes(1),
            ]
        );

        Product::updateOrCreate(
            ['product_code' => 'CON-XBX-2TB'],
            [
                'product_name' => 'Xbox Series X – 2TB Galaxy Black',
                'category_id' => $catGaming,
                'image' => 'images/produkterbaru/xbox.png',
                'description' => 'Konsol next-gen Xbox Series X Special Edition 2TB dengan desain Galaxy Black beraksen kosmik unik, grafis true 4K hingga 120 FPS dan kecepatan SSD luar biasa.',
                'buy_price' => 12500000,
                'sell_price' => 14404000,
                'stock' => 10,
                'status' => 'Available',
                'created_at' => now(),
            ]
        );
    }
}
