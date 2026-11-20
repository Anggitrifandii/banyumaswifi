<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Paket;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Data Paket
        Paket::create(['nama_paket' => 'Paket Hemat', 'kecepatan' => '30 Mbps', 'harga' => 150000]);
        Paket::create(['nama_paket' => 'Paket Cepat', 'kecepatan' => '50 Mbps', 'harga' => 250000]);
        Paket::create(['nama_paket' => 'Paket Gaming', 'kecepatan' => '100 Mbps', 'harga' => 450000]);

        // 2. Akun Admin (Operasional)
        User::create([
            'name' => 'Admin BanyumasWiFi',
            'email' => 'admin@banyumaswifi.com',
            'password' => Hash::make('admin123'), 
            'role' => 'admin',
            'email_verified_at' => Carbon::now(), 
        ]);

        // 3. AKUN BOSS (Pengawasan/Pemilik)
        User::create([
            'name' => 'Pak Boss',
            'email' => 'boss@banyumaswifi.com',
            'password' => Hash::make('boss1234'), 
            'role' => 'boss',
            'email_verified_at' => Carbon::now(), 
        ]);
    }
}