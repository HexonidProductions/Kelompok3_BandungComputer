<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DailyClosing;
use App\Models\User;

class DailyClosingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DailyClosing::create([
            'cashier_id' => User::where('name', 'Nabil')->value('id'),
            'physical_cash' => 1800000,
            'system_cash' => 1800000,
            'discrepancy' => 0,
            'notes' => 'Penutupan kasir shift 1 berjalan lancar, saldo fisik cocok.'
        ]);

        DailyClosing::create([
            'cashier_id' => User::where('name', 'Nabil')->value('id'),
            'physical_cash' => 2000000,
            'system_cash' => 2000000,
            'discrepancy' => 0,
            'notes' => 'Penutupan kasir shift 2 berjalan lancar, saldo fisik cocok.'
        ]);
    }
}
