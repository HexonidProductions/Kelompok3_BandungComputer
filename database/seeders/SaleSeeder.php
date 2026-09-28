<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sale;
use App\Models\User;

class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sale::create([
            'receipt_number' => 'INV-2602-004',
            'sale_type' => 'Offline',
            'admin_id' => User::where('name', 'Nabil')->value('id'),
            'customer_id' => User::where('name', 'Radit')->value('id'),
            'shipping_address' => 'Kompleks Antero Pondok Raya 2, Jalan Pondok Bambu No.35, RT.19/RW.8, Loktabat Utara BANJARBARU UTARA, KOTA BANJARBARU, Kalimantan Selatan, ID 70930',
            'payment_method' => 'Bank Transfer',
            'total_amount' => '24500000',
            'shipping_fee' => '15000',
            'payment_status' => 'Paid',
        ]);

        Sale::create([
            'receipt_number' => 'INV-2602-005',
            'sale_type' => 'Online',
            'admin_id' => User::where('name', 'Alif')->value('id'),
            'customer_id' => User::where('name', 'Cnada')->value('id'),
            'shipping_address' => 'Kompleks Antero Pondok Raya 2, Jalan Pondok Bambu No.35, RT.19/RW.8, Loktabat Utara BANJARBARU UTARA, KOTA BANJARBARU, Kalimantan Selatan, ID 70930',
            'payment_method' => 'Bank Transfer',
            'total_amount' => '24500000',
            'shipping_fee' => '15000',
            'payment_status' => 'Paid',
        ]);

        Sale::create([
            'receipt_number' => 'INV-2602-006',
            'sale_type' => 'Offline',
            'admin_id' => User::where('name', 'Alif')->value('id'),
            'customer_id' => User::where('name', 'Radit')->value('id'),
            'shipping_address' => 'Kompleks Antero Pondok Raya 2, Jalan Pondok Bambu No.35, RT.19/RW.8, Loktabat Utara BANJARBARU UTARA, KOTA BANJARBARU, Kalimantan Selatan, ID 70930',
            'payment_method' => 'Bank Transfer',
            'total_amount' => '24500000',
            'shipping_fee' => '15000',
            'payment_status' => 'Paid',
        ]);
    }
}
