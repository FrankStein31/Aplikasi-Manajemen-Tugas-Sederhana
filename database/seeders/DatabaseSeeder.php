<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create default admin
        User::create([
            'name'    => 'Administrator',
            'email'   => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'jabatan' => 'admin',
            'status'  => 'belum_ditugaskan',
        ]);

        // Create sample karyawan
        User::create([
            'name'    => 'Budi Santoso',
            'email'   => 'karyawan@gmail.com',
            'password' => Hash::make('password'),
            'jabatan' => 'karyawan',
            'status'  => 'belum_ditugaskan',
        ]);
    }
}
