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
            'admin_id' => User::where('name', 'Nabil')->value('id'),
            'total_income' => 1800000,
            'notes' => 'Penutupan kasir shift 1 berjalan lancar.'
        ]);

        DailyClosing::create([
            'admin_id' => User::where('name', 'Nabil')->value('id'),
            'total_income' => 2000000,
            'notes' => 'Penutupan kasir shift 2 berjalan lancar.'
        ]);
    }
}
