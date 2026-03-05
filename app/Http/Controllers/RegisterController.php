<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    // 1. Tampilkan Halaman Form Daftar
    public function show()
    {
        return view('register'); // Pastikan nama file view kakak 'register.blade.php'
    }

    // 2. Proses Data Pendaftaran
    public function store(Request $request)
    {
        // A. Validasi (Cek kelengkapan data)
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            // 👇 Validasi Data Tambahan
            'nisn' => 'required|numeric', 
            'school' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
        ]);

        // B. Simpan ke Database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Password di-enkripsi
            // 👇 Masukkan data tambahan
            'nisn' => $request->nisn,
            'school' => $request->school,
            'phone' => $request->phone,
        ]);

        // C. Login Otomatis (Opsional)
        Auth::login($user);

        // D. Pindah ke Halaman Dashboard
        return redirect('/dashboard')->with('success', 'Pendaftaran berhasil!');
    }
}