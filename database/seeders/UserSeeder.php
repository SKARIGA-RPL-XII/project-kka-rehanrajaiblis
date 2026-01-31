<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin Rumah Sakit',
                'email' => 'admin@rumahsakit.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dr. Ahmad Dokter',
                'email' => 'dokter@rumahsakit.com',
                'password' => Hash::make('dokter123'),
                'role' => 'doktor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pasien Test',
                'email' => 'pasien@rumahsakit.com',
                'password' => Hash::make('pasien123'),
                'role' => 'pasien',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}