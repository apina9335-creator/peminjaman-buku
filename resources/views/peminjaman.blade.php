@extends('layouts.main')

@section('title', 'Peminjaman Saya')

@section('content')
    <div class="page-header">
        <h1>Status Peminjaman 📤</h1>
        <p>Pantau buku yang sedang kamu pinjam dan kedisiplinan pengembalian.</p>
    </div>

    @if(isset($isPenalized) && $isPenalized)
        <div style="background: #fee2e2; border: 1px solid #ef4444; color: #991b1b; padding: 1.5rem; border-radius: 1rem; margin-bottom: 2rem; display: flex; gap: 1rem; align-items: center;">
            <div style="font-size: 2.5rem;">🚫</div>
            <div>
                <h3 style="margin-bottom: 0.2rem; font-weight: 800;">Akun Dibekukan Sementara</h3>
                <p>Anda terkena sanksi karena terlambat mengembalikan buku. Anda tidak dapat meminjam buku baru selama <strong>{{ intval($penaltyDaysLeft) }} hari</strong> lagi.</p>
                <p style="font-size: 0.85rem; margin-top: 0.5rem; opacity: 0.8;">Bebas Sanksi: {{ \Carbon\Carbon::parse($user->penalty_until)->translatedFormat('d F Y, H:i') }}</p>
            </div>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">✅ {{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">⚠️ {{ session('error') }}</div>
    @endif

    <div class="card">
        <div style="font-weight: 700; font-size: 1.2rem; margin-bottom: 1rem; border-bottom: 1px solid var(--border-color); padding-bottom: 0.5rem; color: var(--text-main);">
            📘 Peminjaman Aktif
        </div>
        
        @if($activeLoans->count() > 0)
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: rgba(0,0,0,0.02);">
                    <th style="text-align: left; padding: 1rem; color: var(--text-muted);">Judul Buku</th>
                    <th style="text-align: left; padding: 1rem; color: var(--text-muted);">Tanggal Pinjam</th>
                    <th style="text-align: left; padding: 1rem; color: var(--text-muted);">Jatuh Tempo</th>
                    <th style="text-align: left; padding: 1rem; color: var(--text-muted);">Status</th>
                    <th style="text-align: left; padding: 1rem; color: var(--text-muted);">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($activeLoans as $loan)
                <tr style="border-bottom: 1px solid var(--border-color);">
                    <td style="padding: 1rem;">
                        <div style="font-weight: 700; color: var(--text-main);">{{ $loan->book->title }}</div>
                    </td>
                    <td style="padding: 1rem;">
                        {{ \Carbon\Carbon::parse($loan->loan_date)->format('d M Y') }}
                    </td>
                    
                    {{-- JATUH TEMPO & SISA HARI --}}
                    <td style="padding: 1rem;">
                        <div style="font-weight: 700; color: var(--text-main);">
                            {{ \Carbon\Carbon::parse($loan->return_date)->format('d M Y') }}
                        </div>

                        @php
                            $jatuhTempo = \Carbon\Carbon::parse($loan->return_date);
                            $hariSisa = now()->diffInDays($jatuhTempo, false);
                        @endphp
                        
                        @if($loan->status == 'borrowed')
                            <div style="font-size: 0.75rem; margin-top: 4px;">
                                @if($hariSisa < 0)
                                    <span style="color: var(--danger); font-weight: 800; background: #fee2e2; padding: 2px 6px; border-radius: 4px;">
                                        Telat {{ abs(intval($hariSisa)) }} hari!
                                    </span>
                                @else
                                    <span style="color: var(--success); font-weight: 600;">
                                        Sisa {{ intval($hariSisa) }} hari
                                    </span>
                                @endif
                            </div>
                        @endif
                    </td>

                    <td style="padding: 1rem;">
                        @if($loan->status == 'pending')
                            <span style="background: #fef3c7; color: #d97706; padding: 0.3rem 0.8rem; border-radius: 2rem; font-size: 0.8rem; font-weight: 700;">⏳ Menunggu</span>
                        @elseif($loan->status == 'borrowed') 
                            <span style="background: #dbeafe; color: #1e40af; padding: 0.3rem 0.8rem; border-radius: 2rem; font-size: 0.8rem; font-weight: 700;">📖 Dipinjam</span>
                        @endif
                    </td>

                    <td style="padding: 1rem;">
                        @if($loan->status == 'borrowed' || $loan->status == 'overdue')
                            <form action="{{ route('loans.return', $loan->id) }}" method="POST">
                                @csrf
                                <button type="submit" onclick="return confirm('Apakah Anda yakin ingin mengembalikan buku ini?')" 
                                    style="background: var(--success); color: white; border: none; padding: 0.5rem 1rem; border-radius: 0.5rem; cursor: pointer; font-weight: 600; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                    Kembalikan
                                </button>
                            </form>
                        @else
                            <span style="color: var(--text-muted);">-</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
            <div style="text-align: center; padding: 3rem; color: var(--text-muted);">
                Belum ada buku yang dipinjam.
            </div>
        @endif
    </div>

    <div class="card">
        <div style="font-weight: 700; font-size: 1.2rem; margin-bottom: 1rem; border-bottom: 1px solid var(--border-color); padding-bottom: 0.5rem; color: var(--text-main);">
            🗂️ Riwayat Pengembalian
        </div>

        @if($historyLoans->count() > 0)
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: rgba(0,0,0,0.02);">
                    <th style="text-align: left; padding: 1rem; color: var(--text-muted);">Buku</th>
                    <th style="text-align: left; padding: 1rem; color: var(--text-muted);">Tgl Pinjam</th>
                    <th style="text-align: left; padding: 1rem; color: var(--text-muted);">Tgl Kembali</th>
                    <th style="text-align: left; padding: 1rem; color: var(--text-muted);">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($historyLoans as $loan)
                <tr style="border-bottom: 1px solid var(--border-color);">
                    <td style="padding: 1rem; font-weight: 600;">{{ $loan->book->title }}</td>
                    <td style="padding: 1rem;">{{ \Carbon\Carbon::parse($loan->loan_date)->format('d M Y') }}</td>
                    <td style="padding: 1rem;">
                        @if($loan->status == 'returned')
                            {{ $loan->updated_at->format('d M Y') }}
                        @else
                            -
                        @endif
                    </td>
                    <td style="padding: 1rem;">
                        @if($loan->status == 'returned')
                            <span style="background: #d1fae5; color: #065f46; padding: 0.3rem 0.8rem; border-radius: 2rem; font-size: 0.8rem; font-weight: 700;">✔ Selesai</span>
                        @elseif($loan->status == 'rejected')
                            <span style="background: #fee2e2; color: #991b1b; padding: 0.3rem 0.8rem; border-radius: 2rem; font-size: 0.8rem; font-weight: 700;">✖ Ditolak</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
@endsection