<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit'); // Akan menampilkan halaman form
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // 1. Validasi input
        // Validasi 'avatar' dihapus karena gambar yang dikirim sekarang berupa teks Base64, bukan file biasa
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        // 2. Update data teks
        $user->name = $request->name;
        $user->email = $request->email;

        // 3. Proses gambar hasil crop (Base64)
        // Kita mengecek input hidden 'avatar_base64' yang dikirim dari Javascript
        if ($request->avatar_base64) {
            
            // Hapus foto lama jika ada
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            // Memecah teks Base64 untuk mengambil murni data gambarnya saja
            $image_parts = explode(";base64,", $request->avatar_base64);
            $image_base64 = base64_decode($image_parts[1]);
            
            // Buat nama file unik (misal: avatars/64abcdef12345.png)
            $fileName = 'avatars/' . uniqid() . '.png';
            
            // Simpan ke folder public/storage/avatars
            Storage::disk('public')->put($fileName, $image_base64);
            
            // Masukkan nama file ke database
            $user->avatar = $fileName;
        }

        // 4. Simpan ke database
        $user->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }
}