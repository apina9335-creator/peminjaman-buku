<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;
use App\Models\Book;
use App\Models\User;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // === DASHBOARD USER ===
    public function index()
    {
        $user = Auth::user();
        
        $totalLoans = Loan::where('user_id', $user->id)->count();
        $pendingLoans = Loan::where('user_id', $user->id)->where('status', 'pending')->count();
        
        $overdueLoans = Loan::where('user_id', $user->id)
                            ->where('status', 'borrowed')
                            ->where('return_date', '<', now())
                            ->count();

        $recentLoans = Loan::where('user_id', $user->id)
                           ->with('book')
                           ->orderBy('created_at', 'desc')
                           ->take(5)
                           ->get();

        // [PERBAIKAN] Mengambil daftar bukunya (bukan cuma angka) agar tidak error saat di-looping
        $activeLoans = Loan::where('user_id', $user->id)
                           ->where('status', 'borrowed')
                           ->with('book')
                           ->get(); 
        
        // [BARU] Menghitung angka statis untuk kotak-kotak di Dashboard
        $stats = [
            'active_loans' => $activeLoans->count(),
            'favorites' => $user->favorites()->count(),
            'total_returned' => Loan::where('user_id', $user->id)->where('status', 'returned')->count()
        ];

        // Mengambil daftar buku terbaru
        $newBooks = Book::orderBy('created_at', 'desc')->take(6)->get();

        // Menghitung statistik peminjaman per bulan untuk grafik Chart.js
        $monthlyLoans = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthlyLoans[] = Loan::where('user_id', $user->id)
                ->whereYear('borrow_date', date('Y'))
                ->whereMonth('borrow_date', $i)
                ->count();
        }

        return view('dashboard.index', compact('user', 'totalLoans', 'activeLoans', 'pendingLoans', 'overdueLoans', 'recentLoans', 'monthlyLoans', 'stats', 'newBooks'));
    }

    // === DASHBOARD ADMIN ===
    public function adminIndex()
    {
        $bookCount = Book::count();
        $userCount = User::where('is_admin', 0)->count();
        $activeLoansCount = Loan::where('status', 'borrowed')->count();
        $pendingLoansCount = Loan::where('status', 'pending')->count();
        $reviewsCount = Review::count();

        return view('admin.dashboard', compact('bookCount', 'userCount', 'activeLoansCount', 'pendingLoansCount', 'reviewsCount'));
    }
}