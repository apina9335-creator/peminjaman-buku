<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        // Ambil semua user KECUALI admin yang sedang login (agar tidak menghapus diri sendiri)
        // Kita juga bisa filter where('is_admin', 0) jika ingin hanya melihat user biasa
        $users = User::where('id', '!=', auth()->id())
                     ->orderBy('created_at', 'desc')
                     ->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        // Opsional: Hapus foto profil jika ada
        // if ($user->avatar) Storage::delete($user->avatar);
        
        $user->delete();

        return back()->with('success', 'Akun pengguna berhasil dihapus.');
    }
}