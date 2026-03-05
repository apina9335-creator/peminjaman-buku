<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoritesController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // Ambil buku yang difavoritkan user
        $favorites = $user->favorites;

        // Hitung Statistik untuk ditampilkan di Dashboard Favorit
        $stats = [
            'total' => $favorites->count(),
            'available' => $favorites->where('stock', '>', 0)->count(),
            'borrowed' => $favorites->where('stock', '<=', 0)->count(),
        ];

        return view('favorit', compact('favorites', 'stats'));
    }

    // Fungsi untuk Tambah/Hapus Favorit (Toggle)
    public function toggle(Request $request)
    {
        $book_id = $request->book_id;
        $user = Auth::user();

        // Jika sudah ada -> hapus. Jika belum ada -> tambah.
        $user->favorites()->toggle($book_id);

        return back()->with('success', 'Daftar favorit diperbarui!');
    }
}