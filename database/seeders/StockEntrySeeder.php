<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\StockEntry;

class StockEntrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StockEntry::create([
            'entry_code' => 'SPL-ASUS',
            'supplier_name' => 'PT. Asus Indonesia',
            'phone_number' => '082122431234',
            'address' => 'Kuningan, Jakarta Selatan',
            'status' => 'Active',
        ]);

        StockEntry::create([
            'entry_code' => 'SPL-LENOVO',
            'supplier_name' => 'PT. Lenovo Indonesia',
            'phone_number' => '082122431235',
            'address' => 'Kelapa Gading, Jakarta Utara',
            'status' => 'Active',
        ]);
    }
}
