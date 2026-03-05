@extends('layouts.main')

@section('title', 'Dashboard - PinjamBuku')

@section('styles')
<style>
    /* CSS Khusus Dashboard Saja */
    .hero-card { background: var(--bg-card); border: 1px solid var(--border-color); padding: 2rem; border-radius: 1.5rem; box-shadow: 0 4px 6px var(--shadow); margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: center; }
    .hero-text h1 { font-size: 1.8rem; margin-bottom: 0.5rem; color: var(--text-main); }
    .btn-primary { background: var(--primary); color: white; padding: 0.75rem 1.5rem; border-radius: 0.75rem; font-weight: 600; display: inline-block; margin-top: 1rem; }
    
    .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1.5rem; margin-bottom: 3rem; }
    .stat-card { background: var(--bg-card); padding: 1.5rem; border-radius: 1rem; border: 1px solid var(--border-color); display: flex; flex-direction: column; }
    .stat-value { font-size: 2.5rem; font-weight: 700; color: var(--text-main); }
    
    .section-title { font-size: 1.25rem; font-weight: 700; margin-bottom: 1.5rem; display: flex; justify-content: space-between; align-items: center; color: var(--text-main); }
    .books-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 1.5rem; }
    .book-card { background: var(--bg-card); border-radius: 1rem; overflow: hidden; border: 1px solid var(--border-color); }
    .book-cover { height: 200px; background: var(--bg-body); display: flex; align-items: center; justify-content: center; font-size: 2rem; color: var(--text-muted); }
    .book-details { padding: 1rem; }
</style>
@endsection

@section('content')

    <div class="hero-card">
        <div class="hero-text">
            <h1>Selamat Datang di PinjamBuku! 👋</h1>
            <p>Akses ribuan buku digital dan fisik dengan mudah dari mana saja.</p>
            <a href="{{ route('books.collection') }}" class="btn-primary">Jelajahi Koleksi 📖</a>
        </div>
        <div style="font-size: 5rem;">📚</div>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div style="font-size: 2rem; margin-bottom: 1rem;">📤</div>
            <div class="stat-value" style="color: var(--warning);">{{ $stats['active_loans'] }}</div>
            <div style="color: var(--text-muted);">Sedang Dipinjam</div>
        </div>
        <div class="stat-card">
            <div style="font-size: 2rem; margin-bottom: 1rem;">❤️</div>
            <div class="stat-value" style="color: var(--danger);">{{ $stats['favorites'] }}</div>
            <div style="color: var(--text-muted);">Buku Favorit</div>
        </div>
        <div class="stat-card">
            <div style="font-size: 2rem; margin-bottom: 1rem;">✅</div>
            <div class="stat-value" style="color: var(--success);">{{ $stats['total_returned'] }}</div>
            <div style="color: var(--text-muted);">Buku Dikembalikan</div>
        </div>
    </div>

    <div class="section-title">
        <span>🔥 Buku Terbaru</span>
        <a href="{{ route('books.collection') }}" style="font-size: 0.9rem; color: var(--primary);">Lihat Semua</a>
    </div>
    
    <div class="books-grid">
        @foreach($newBooks as $book)
        <a href="{{ route('books.collection') }}" class="book-card">
            <div class="book-cover">
                @if($book->cover_image)
                    <img src="{{ asset('storage/' . $book->cover_image) }}" style="width: 100%; height: 100%; object-fit: cover;">
                @else
                    <span>{{ substr($book->title, 0, 1) }}</span>
                @endif
            </div>
            <div class="book-details">
                <div style="font-weight: 700; color: var(--text-main);">{{ $book->title }}</div>
                <div style="font-size: 0.8rem; color: var(--text-muted);">{{ $book->author }}</div>
            </div>
        </a>
        @endforeach
    </div>

@endsection