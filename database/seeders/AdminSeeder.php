<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Perbaikan: Gunakan 'is_admin' => 1 agar sesuai dengan pengecekan di AuthController
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@pinjambuku.com',
            'password' => Hash::make('password'),
            'is_admin' => 1, // <--- Ubah dari 'role' => 'admin' menjadi ini
            'email_verified_at' => now(),
        ]);
        
        User::create([
            'name' => 'Siswa Teladan',
            'email' => 'siswa@sekolah.com',
            'password' => Hash::make('password123'),
            'is_admin' => 0, // <--- User biasa
            'email_verified_at' => now(),
        ]);
    }
}