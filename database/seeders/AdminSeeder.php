<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        User::create([
            'name' => 'Super Admin', // Nama bebas
            'email' => 'admin@pinjambuku.com', // Email login
            'password' => Hash::make('password'), // Password login
            'role' => 'admin', // <--- Langsung set jadi admin!
            'email_verified_at' => now(), // <--- Agar tidak perlu verifikasi email lagi
        ]);
        
        // Mau tambah akun user biasa sekalian? Bisa juga:
        User::create([
            'name' => 'Siswa Teladan',
            'email' => 'siswa@sekolah.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
            'email_verified_at' => now(),
        ]);
    }
}