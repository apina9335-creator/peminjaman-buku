@extends('layouts.main')

@section('title', 'Riwayat Aktivitas')

@section('content')
    <div class="page-header">
        <h1>Riwayat Peminjaman 📋</h1>
        <p>Jejak lengkap semua buku yang pernah Anda pinjam.</p>
    </div>

    <div class="card">
        <div style="font-weight: 700; font-size: 1.2rem; margin-bottom: 1rem; border-bottom: 1px solid var(--border-color); padding-bottom: 0.5rem; color: var(--text-main);">
            📜 Log Transaksi
        </div>

        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: rgba(0,0,0,0.02); border-bottom: 2px solid var(--border-color);">
                    <th style="text-align: left; padding: 1rem; color: var(--text-muted);">Buku</th>
                    <th style="text-align: left; padding: 1rem; color: var(--text-muted);">Tanggal Pinjam</th>
                    <th style="text-align: left; padding: 1rem; color: var(--text-muted);">Tanggal Selesai</th>
                    <th style="text-align: left; padding: 1rem; color: var(--text-muted);">Status Akhir</th>
                </tr>
            </thead>
            <tbody>
                @forelse($historyLoans as $loan)
                <tr style="border-bottom: 1px solid var(--border-color);">
                    {{-- 1. JUDUL BUKU --}}
                    <td style="padding: 1rem;">
                        <div style="font-weight: 700; color: var(--text-main);">{{ $loan->book->title }}</div>
                        <div style="font-size: 0.8rem; color: var(--text-muted);">{{ $loan->book->author }}</div>
                    </td>

                    {{-- 2. TANGGAL PINJAM --}}
                    <td style="padding: 1rem; color: var(--text-muted);">
                        {{ \Carbon\Carbon::parse($loan->loan_date)->format('d M Y') }}
                    </td>
                    
                    {{-- 3. TANGGAL SELESAI (Perbaikan Di Sini) --}}
                    <td style="padding: 1rem; color: var(--text-main);">
                        @if($loan->status == 'returned')
                            {{-- Jika sudah kembali: Tampilkan tanggal dikembalikan --}}
                            {{ $loan->updated_at->format('d M Y') }}
                        
                        @elseif($loan->status == 'borrowed' || $loan->status == 'overdue')
                            {{-- Jika sedang dipinjam: Tampilkan Jatuh Tempo (Sesuai durasi awal) --}}
                            <span style="color: var(--primary); font-weight: 600;">
                                {{ \Carbon\Carbon::parse($loan->return_date)->format('d M Y') }}
                            </span>
                            <div style="font-size: 0.75rem; color: var(--text-muted);">
                                (Jatuh Tempo)
                            </div>
                        @else
                            -
                        @endif
                    </td>

                    {{-- 4. STATUS --}}
                    <td style="padding: 1rem;">
                        @if($loan->status == 'returned')
                            <span style="background: #d1fae5; color: #065f46; padding: 0.3rem 0.8rem; border-radius: 2rem; font-size: 0.8rem; font-weight: 700;">
                                ✔ Selesai
                            </span>
                        @elseif($loan->status == 'rejected')
                            <span style="background: #fee2e2; color: #991b1b; padding: 0.3rem 0.8rem; border-radius: 2rem; font-size: 0.8rem; font-weight: 700;">
                                ✖ Ditolak
                            </span>
                        @elseif($loan->status == 'borrowed') 
                            <span style="background: #dbeafe; color: #1e40af; padding: 0.3rem 0.8rem; border-radius: 2rem; font-size: 0.8rem; font-weight: 700;">
                                📖 Dipinjam
                            </span>
                        @elseif($loan->status == 'overdue') 
                            <span style="background: #fee2e2; color: #991b1b; padding: 0.3rem 0.8rem; border-radius: 2rem; font-size: 0.8rem; font-weight: 700;">
                                ⚠️ Terlambat
                            </span>
                        @else
                            <span style="background: #fef3c7; color: #d97706; padding: 0.3rem 0.8rem; border-radius: 2rem; font-size: 0.8rem; font-weight: 700;">
                                ⏳ Menunggu
                            </span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="text-align: center; padding: 3rem; color: var(--text-muted);">
                        Belum ada riwayat aktivitas.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection