<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // Alamat Model
use Illuminate\Support\Facades\Hash; // Alamat untuk Enkripsi Password

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrator Qi',
            'email' => 'admin@pos.com',
            'password' => Hash::make('password'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'Kepala Toko Sam',
            'email' => 'kepala@pos.com',
            'password' => Hash::make('password'),
            'role' => 'kepala toko'
        ]);

        User::create([
            'name' => 'Kasir Fragile',
            'email' => 'kasir@pos.com',
            'password' => Hash::make('password'),
            'role' => 'kasir'
        ]);
    }
}