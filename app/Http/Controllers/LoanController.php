<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LoanController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Cek apakah user sedang dalam masa hukuman
        $isPenalized = $user->penalty_until && Carbon::now()->lessThan($user->penalty_until);
        $penaltyDaysLeft = $isPenalized ? Carbon::now()->diffInDays($user->penalty_until) + 1 : 0;

        $activeLoans = Loan::with('book')
                    ->where('user_id', $user->id)
                    ->whereIn('status', ['pending', 'approved', 'borrowed', 'overdue'])
                    ->orderBy('created_at', 'desc')
                    ->get();

        $historyLoans = Loan::with('book')
                    ->where('user_id', $user->id)
                    ->whereIn('status', ['returned', 'rejected'])
                    ->orderBy('updated_at', 'desc')
                    ->get();

        return view('peminjaman', compact('activeLoans', 'historyLoans', 'user', 'isPenalized', 'penaltyDaysLeft'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        // 1. CEK STATUS HUKUMAN (SANKSI)
        if ($user->penalty_until && Carbon::now()->lessThan($user->penalty_until)) {
            $tanggalBebas = Carbon::parse($user->penalty_until)->translatedFormat('d F Y H:i');
            return back()->with('error', "AKUN DIBEKUKAN! Anda terkena sanksi keterlambatan. Anda baru bisa meminjam lagi pada: $tanggalBebas");
        }

        $request->validate([
            'book_id' => 'required|exists:books,id',
            'duration' => 'required|integer|min:1|max:14',
        ]);

        $book = Book::findOrFail($request->book_id);

        if ($book->stock < 1) {
            return back()->with('error', 'Stok buku habis!');
        }

        $existingLoan = Loan::where('user_id', $user->id)
                            ->where('book_id', $book->id)
                            ->whereIn('status', ['pending', 'approved', 'borrowed'])
                            ->exists();

        if ($existingLoan) {
            return back()->with('error', 'Anda sedang meminjam buku ini.');
        }

        Loan::create([
            'user_id' => $user->id,
            'book_id' => $book->id,
            'borrow_date' => Carbon::now(),
            'return_date' => Carbon::now()->addDays((int) $request->duration), 
            'status' => 'pending',
            'notes' => $request->notes
        ]);

        $book->decrement('stock');

        return back()->with('success', 'Pengajuan berhasil! Menunggu persetujuan admin.');
    }

    public function returnBook($id)
    {
        $loan = Loan::findOrFail($id);
        $user = Auth::user();

        if ($loan->user_id != $user->id) {
            return back()->with('error', 'Akses tidak sah.');
        }

        if ($loan->status == 'borrowed' || $loan->status == 'overdue') {
            $loan->status = 'returned';
            $loan->save();
            $loan->book->increment('stock');

            // 2. LOGIKA HITUNG DENDA / SANKSI
            $jatuhTempo = Carbon::parse($loan->return_date);
            $tanggalKembali = Carbon::now();

            // Jika Terlambat (Tanggal Kembali > Jatuh Tempo)
            if ($tanggalKembali->greaterThan($jatuhTempo)) {
                
                // Tambah jumlah pelanggaran
                $user->increment('violation_count');
                
                // Rumus Hukuman: 
                // Pelanggaran ke-1 = 2 hari
                // Pelanggaran ke-2 = 4 hari
                // Pelanggaran ke-3 = 6 hari, dst.
                $lamaSanksi = $user->violation_count * 2; 

                $user->penalty_until = Carbon::now()->addDays($lamaSanksi);
                $user->save();

                return back()->with('error', "Buku dikembalikan TERLAMBAT! Anda terkena sanksi tidak bisa meminjam selama $lamaSanksi hari (Pelanggaran ke-{$user->violation_count}).");
            }

            return back()->with('success', 'Buku berhasil dikembalikan tepat waktu. Terima kasih!');
        }

        return back()->with('error', 'Status peminjaman tidak valid.');
    }
}