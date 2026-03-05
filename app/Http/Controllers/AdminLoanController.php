<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;

class AdminLoanController extends Controller
{
    // ==========================================
    // 1. VALIDASI PEMINJAMAN (Approval)
    // ==========================================
    
    public function index()
    {
        // Ambil semua peminjaman yang statusnya 'pending' (Menunggu)
        $loans = Loan::with(['user', 'book'])
                     ->where('status', 'pending')
                     ->orderBy('created_at', 'asc')
                     ->get();

        return view('admin.loans.index', compact('loans'));
    }

    public function approve($id)
    {
        $loan = Loan::findOrFail($id);
        
        // 1. Hitung durasi hari yang diminta user (Jatuh Tempo Awal - Tgl Ajukan)
        $tglAjukan = \Carbon\Carbon::parse($loan->loan_date);
        $tglKembaliLama = \Carbon\Carbon::parse($loan->return_date);
        
        // Ambil selisih hari (misal: 7 hari)
        $durasiHari = $tglAjukan->diffInDays($tglKembaliLama);

        // 2. RESET Tanggal Pinjam jadi HARI INI (Waktu Admin Klik Setuju)
        $loan->loan_date = now();
        
        // 3. RESET Jatuh Tempo (Hari Ini + Durasi Awal)
        // Jadi user tetap dapat full 7 hari terhitung dari sekarang
        $loan->return_date = now()->addDays($durasiHari);

        // 4. Ubah status jadi 'borrowed'
        $loan->status = 'borrowed'; 
        $loan->save();

        return back()->with('success', 'Disetujui! Waktu peminjaman dimulai dari sekarang (' . $durasiHari . ' hari).');
    }

    public function reject($id)
    {
        $loan = Loan::findOrFail($id);
        
        // Ubah status menjadi 'rejected'
        $loan->status = 'rejected';
        $loan->save();

        // Kembalikan stok buku karena batal pinjam
        $loan->book->increment('stock');

        return back()->with('success', 'Peminjaman ditolak.');
    }

    // ==========================================
    // 2. MONITORING & PENGEMBALIAN OLEH ADMIN
    // ==========================================

    // Menampilkan daftar buku yang SEDANG DIPINJAM (borrowed / overdue)
    public function activeLoans()
    {
        $loans = Loan::with(['user', 'book'])
                     ->whereIn('status', ['borrowed', 'overdue'])
                     ->orderBy('return_date', 'asc') // Urutkan dari yang paling dekat jatuh temponya
                     ->get();

        return view('admin.loans.active', compact('loans'));
    }

    // Admin memproses pengembalian buku (misal user mengembalikan langsung ke meja admin)
    public function adminReturn($id)
    {
        $loan = Loan::findOrFail($id);
        $user = $loan->user; // Ambil data user peminjam

        // Pastikan statusnya memang sedang dipinjam
        if (in_array($loan->status, ['borrowed', 'overdue'])) {
            
            // 1. Proses Pengembalian Standar
            $loan->status = 'returned';
            $loan->save();
            
            // 2. Kembalikan stok buku
            $loan->book->increment('stock');

            // 3. === LOGIKA HUKUMAN (SANKSI) ===
            // Cek apakah pengembalian ini terlambat?
            $jatuhTempo = \Carbon\Carbon::parse($loan->return_date);
            $tanggalKembali = now();

            if ($tanggalKembali->greaterThan($jatuhTempo)) {
                // a. Tambah counter pelanggaran user
                $user->increment('violation_count');
                
                // b. Hitung lama sanksi (Jumlah Pelanggaran * 2 hari)
                $lamaSanksi = $user->violation_count * 2; 

                // c. Terapkan sanksi ke akun user (blokir pinjam)
                $user->penalty_until = now()->addDays($lamaSanksi);
                $user->save();

                return back()->with('success', "Buku berhasil dikembalikan. NAMUN TERLAMBAT! User terkena sanksi blokir $lamaSanksi hari.");
            }

            return back()->with('success', 'Buku berhasil dikembalikan oleh Admin tepat waktu.');
        }

        return back()->with('error', 'Status peminjaman tidak valid.');
    }
}