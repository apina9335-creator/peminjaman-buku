<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Kita ambil SEMUA data peminjaman (Baik yang aktif maupun yang sudah selesai)
        // Kita namakan variabelnya '$historyLoans' agar cocok dengan View
        $historyLoans = Loan::with('book')
                            ->where('user_id', $user->id)
                            ->orderBy('created_at', 'desc') // Urutkan dari yang terbaru
                            ->get();

        // Kirim ke view 'riwayat' dengan variabel 'historyLoans'
        return view('riwayat', compact('historyLoans'));
    }
}