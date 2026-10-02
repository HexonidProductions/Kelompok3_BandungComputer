<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
            'role' => 'admin',
            'phone_number' => '081234567890',
            'address' => 'Jl. Merdeka 1',
        ]);

        User::create([
            'name' => 'Nabil',
            'email' => 'nabil@gmail.com',
            'password' => Hash::make('124'),
            'role' => 'admin',
            'phone_number' => '081234567891',
            'address' => 'Jl. Merdeka 2',
        ]);

        User::create([
            'name' => 'Alif',
            'email' => 'alif@gmail.com',
            'password' => Hash::make('125'),
            'role' => 'admin',
            'phone_number' => '081234567892',
            'address' => 'Jl. Merdeka 3',
        ]);

        User::create([
            'name' => 'Radit',
            'email' => 'radit@gmail.com',
            'password' => Hash::make('126'),
            'role' => 'customer',
            'phone_number' => '081234567893',
            'address' => 'Jl. Merdeka 4',
        ]);

        User::create([
            'name' => 'Cnada',
            'email' => 'cnada@gmail.com',
            'password' => Hash::make('127'),
            'role' => 'customer',
            'phone_number' => '081234567894',
            'address' => 'Jl. Merdeka 5',
        ]);

        User::create([
            'name' => 'Qourta',
            'email' => 'qourta@gmail.com',
            'password' => Hash::make('128'),
            'role' => 'admin',
            'phone_number' => '081234567895',
            'address' => 'Jl. Merdeka 6',
        ]);

        User::create([
            'name' => 'Danish',
            'email' => 'danish@gmail.com',
            'password' => Hash::make('129'),
            'role' => 'admin',
            'phone_number' => '081234567896',
            'address' => 'Jl. Merdeka 7',
        ]);

        User::create([
            'name' => 'Zhafran',
            'email' => 'zhafran@gmail.com',
            'password' => Hash::make('1210'),
            'role' => 'admin',
            'phone_number' => '081234567897',
            'address' => 'Jl. Merdeka 8',
        ]);

        User::create([
            'name' => 'Miko',
            'email' => 'miko@gmail.com',
            'password' => Hash::make('1211'),
            'role' => 'admin',
            'phone_number' => '081234567898',
            'address' => 'Jl. Merdeka 8',
        ]);

        User::create([
            'name' => 'Rafif',
            'email' => 'rafif@gmail.com',
            'password' => Hash::make('1212'),
            'role' => 'admin',
            'phone_number' => '081234567899',
            'address' => 'Jl. Merdeka 9',
        ]);

        User::create([
            'name' => 'Crystian',
            'email' => 'crystian@gmail.com',
            'password' => Hash::make('1213'),
            'role' => 'admin',
            'phone_number' => '0812345678910',
            'address' => 'Jl. Merdeka 10',
        ]);

        User::create([
            'name' => 'Fatih',
            'email' => 'fatih@gmail.com',
            'password' => Hash::make('1211'),
            'role' => 'admin',
            'phone_number' => '0812345678911',
            'address' => 'Jl. Merdeka 11',
        ]);
}
}