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
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dokter',
                'email' => 'dokter@rumahsakit.com',
                'password' => Hash::make('dokter123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Perawat',
                'email' => 'perawat@rumahsakit.com',
                'password' => Hash::make('perawat123'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}