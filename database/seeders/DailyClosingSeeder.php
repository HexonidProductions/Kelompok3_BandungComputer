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
            'admin_id' => User::where('name', 'Alif')->value('id'),
            'total_income' => 1800000,
            'notes' => 'Penutupan kasir shift 1 berjalan lancar.'
        ]);

        DailyClosing::create([
            'admin_id' => User::where('name', 'Zaidan')->value('id'),
            'total_income' => 2000000,
            'notes' => 'Penutupan kasir shift 2 berjalan lancar.'
        ]);
        DailyClosing::create([
            'admin_id' => User::where('name', 'Cnada')->value('id'),
            'total_income' => 2000000,
            'notes' => 'Penutupan kasir shift 2 berjalan lancar.'
        ]);
        DailyClosing::create([
            'admin_id' => User::where('name', 'Radit')->value('id'),
            'total_income' => 2000000,
            'notes' => 'Penutupan kasir shift 2 berjalan lancar.'
        ]);
        DailyClosing::create([
            'admin_id' => User::where('name', 'Nabil')->value('id'),
            'total_income' => 2000000,
            'notes' => 'Penutupan kasir shift 2 berjalan lancar.'
        ]);
        DailyClosing::create([
            'admin_id' => User::where('name', 'Fatih')->value('id'),
            'total_income' => 2000000,
            'notes' => 'Penutupan kasir shift 2 berjalan lancar.'
        ]);
        DailyClosing::create([
            'admin_id' => User::where('name', 'Miko')->value('id'),
            'total_income' => 2000000,
            'notes' => 'Penutupan kasir shift 2 berjalan lancar.'
        ]);
        DailyClosing::create([
            'admin_id' => User::where('name', 'Rafif')->value('id'),
            'total_income' => 2000000,
            'notes' => 'Penutupan kasir shift 2 berjalan lancar.'
        ]);
        DailyClosing::create([
            'admin_id' => User::where('name', 'Qourta')->value('id'),
            'total_income' => 2000000,
            'notes' => 'Penutupan kasir shift 2 berjalan lancar.'
        ]);
        DailyClosing::create([
            'admin_id' => User::where('name', 'Danish')->value('id'),
            'total_income' => 2000000,
            'notes' => 'Penutupan kasir shift 2 berjalan lancar.'
        ]);
        DailyClosing::create([
            'admin_id' => User::where('name', 'Crystian')->value('id'),
            'total_income' => 2000000,
            'notes' => 'Penutupan kasir shift 2 berjalan lancar.'
        ]);
        DailyClosing::create([
            'admin_id' => User::where('name', 'Zhafran')->value('id'),
            'total_income' => 2000000,
            'notes' => 'Penutupan kasir shift 2 berjalan lancar.'
        ]);
    }
}
