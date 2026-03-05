@extends('layouts.main')

@section('title', 'Monitoring Pinjaman')

@section('content')
    <div class="page-header">
        <h1>Monitoring Pinjaman 🔭</h1>
        <p>Daftar buku yang sedang dipinjam oleh anggota (Belum kembali).</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success">✅ {{ session('success') }}</div>
    @endif

    <div class="card">
        <div style="font-weight: 700; font-size: 1.2rem; margin-bottom: 1.5rem; border-bottom: 1px solid var(--border-color); padding-bottom: 0.5rem;">
            📊 Daftar Peminjam Aktif
        </div>

        @if($loans->count() > 0)
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: rgba(0,0,0,0.02);">
                    <th style="text-align: left; padding: 1rem; color: var(--text-muted);">Peminjam</th>
                    <th style="text-align: left; padding: 1rem; color: var(--text-muted);">Buku</th>
                    <th style="text-align: left; padding: 1rem; color: var(--text-muted);">Tgl Pinjam</th>
                    <th style="text-align: left; padding: 1rem; color: var(--text-muted);">Jatuh Tempo</th>
                    <th style="text-align: left; padding: 1rem; color: var(--text-muted);">Status</th>
                    <th style="text-align: left; padding: 1rem; color: var(--text-muted);">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($loans as $loan)
                <tr style="border-bottom: 1px solid var(--border-color);">
                    {{-- 1. PEMINJAM --}}
                    <td style="padding: 1rem;">
                        <div style="font-weight: 700;">{{ $loan->user->name }}</div>
                        <div style="font-size: 0.8rem; color: var(--text-muted);">{{ $loan->user->email }}</div>
                    </td>

                    {{-- 2. BUKU --}}
                    <td style="padding: 1rem;">{{ $loan->book->title }}</td>

                    {{-- 3. TGL PINJAM --}}
                    <td style="padding: 1rem;">
                        {{ \Carbon\Carbon::parse($loan->loan_date)->format('d M Y') }}
                    </td>

                    {{-- 4. JATUH TEMPO (Hitung Sisa Hari) --}}
                    <td style="padding: 1rem;">
                        <div style="font-weight: 700;">
                            {{ \Carbon\Carbon::parse($loan->return_date)->format('d M Y') }}
                        </div>
                        
                        @php
                            $jatuhTempo = \Carbon\Carbon::parse($loan->return_date);
                            $hariSisa = now()->diffInDays($jatuhTempo, false);
                        @endphp

                        <div style="font-size: 0.75rem; margin-top: 5px;">
                            @if($hariSisa < 0)
                                <span style="color: white; background: var(--danger); padding: 2px 6px; border-radius: 4px; font-weight: bold;">
                                    Telat {{ abs(intval($hariSisa)) }} Hari
                                </span>
                            @else
                                <span style="color: var(--success); font-weight: 600;">
                                    Sisa {{ intval($hariSisa) }} Hari
                                </span>
                            @endif
                        </div>
                    </td>

                    {{-- 5. STATUS --}}
                    <td style="padding: 1rem;">
                        @if($loan->status == 'overdue' || $hariSisa < 0)
                            <span style="background: #fee2e2; color: #991b1b; padding: 0.3rem 0.8rem; border-radius: 2rem; font-size: 0.8rem; font-weight: 700;">⚠️ Terlambat</span>
                        @else
                            <span style="background: #dbeafe; color: #1e40af; padding: 0.3rem 0.8rem; border-radius: 2rem; font-size: 0.8rem; font-weight: 700;">📖 Dipinjam</span>
                        @endif
                    </td>

                    {{-- 6. AKSI (Admin Return) --}}
                    <td style="padding: 1rem;">
                        <form action="{{ route('admin.loans.return', $loan->id) }}" method="POST">
                            @csrf
                            <button type="submit" onclick="return confirm('Apakah buku ini sudah dikembalikan ke Admin?')" 
                                style="background: var(--success); color: white; border: none; padding: 0.5rem 1rem; border-radius: 0.5rem; cursor: pointer; font-weight: 600; font-size: 0.85rem;">
                                ✅ Selesai
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
            <div style="text-align: center; padding: 3rem; color: var(--text-muted);">
                Tidak ada buku yang sedang dipinjam saat ini.
            </div>
        @endif
    </div>
@endsection