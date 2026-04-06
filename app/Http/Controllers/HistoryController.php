<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Mengambil semua riwayat peminjaman user, diurutkan dari yang terbaru
        // UBAH NAMA VARIABEL MENJADI $history AGAR COCOK DENGAN BLADE
        $history = Loan::with('book')
                       ->where('user_id', $user->id)
                       ->orderBy('created_at', 'desc')
                       ->get();

        // Mengirimkan variabel $history ke tampilan riwayat.blade.php
        return view('riwayat', compact('user', 'history'));
    }
}