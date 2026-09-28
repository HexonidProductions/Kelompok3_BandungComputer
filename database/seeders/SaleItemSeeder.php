<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SaleItem;
use App\Models\Sale;
use App\Models\Product;

class SaleItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SaleItem::create([
            'sale_id' => Sale::where('receipt_number', 'INV-2602-004')->value('id'),
            'product_id' => Product::where('product_code', 'LPT-ROG14')->value('id'),
            'quantity' => '1',
            'unit_price' => '24500000',
        ]);

        SaleItem::create([
            'sale_id' => Sale::where('receipt_number', 'INV-2602-004')->value('id'),
            'product_id' => Product::where('product_code', 'LPT-ROG13')->value('id'),
            'quantity' => '2',
            'unit_price' => '24500000',
        ]);
    }
}
