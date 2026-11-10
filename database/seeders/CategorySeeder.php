<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::firstOrCreate(['category_name' => 'Laptop']);
        Category::firstOrCreate(['category_name' => 'Handphone']);
        Category::firstOrCreate(['category_name' => 'Headset']);
        Category::firstOrCreate(['category_name' => 'Gaming']);
        Category::firstOrCreate(['category_name' => 'Aksesoris']);
    }
}
