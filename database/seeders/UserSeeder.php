<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Zaidan',
            'email' => 'hexonidproduction@gmail.com',
            'password' => Hash::make('123'),
            'role' => 'Admin',
            'phone_number' => '081234567890',
            'address' => 'Jl. Merdeka 1',
        ]);

        User::create([
            'name' => 'Nabil',
            'email' => 'nabil@gmail.com',
            'password' => Hash::make('124'),
            'role' => 'Cashier',
            'phone_number' => '081234567891',
            'address' => 'Jl. Merdeka 2',
        ]);

        User::create([
            'name' => 'Alif',
            'email' => 'alif@gmail.com',
            'password' => Hash::make('125'),
            'role' => 'Cashier',
            'phone_number' => '081234567892',
            'address' => 'Jl. Merdeka 3',
        ]);

        User::create([
            'name' => 'Radit',
            'email' => 'radit@gmail.com',
            'password' => Hash::make('126'),
            'role' => 'Customer',
            'phone_number' => '081234567893',
            'address' => 'Jl. Merdeka 4',
        ]);

        User::create([
            'name' => 'Cnada',
            'email' => 'cnada@gmail.com',
            'password' => Hash::make('127'),
            'role' => 'Customer',
            'phone_number' => '081234567894',
            'address' => 'Jl. Merdeka 5',
        ]);
}
}