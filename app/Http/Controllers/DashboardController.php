<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Loan;
use App\Models\Book;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // 1. Ambil Statistik User
        $stats = [
            'active_loans' => Loan::where('user_id', $user->id)->where('status', 'approved')->count(),
            'total_returned' => Loan::where('user_id', $user->id)->where('status', 'returned')->count(),
            'favorites' => $user->favorites()->count(), // Pastikan relasi favorites sudah ada di Model User
        ];

        // 2. Ambil Buku yang SEDANG DIPINJAM (Agar user ingat mengembalikan)
        $activeLoans = Loan::with('book')
                            ->where('user_id', $user->id)
                            ->where('status', 'approved')
                            ->orderBy('return_date', 'asc') // Urutkan yang deadline-nya paling dekat
                            ->take(3)
                            ->get();

        // 3. Ambil Buku TERBARU untuk rekomendasi
        $newBooks = Book::latest()->take(4)->get();

        return view('dashboard', compact('user', 'stats', 'activeLoans', 'newBooks'));
    }
}