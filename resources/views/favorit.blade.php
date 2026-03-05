@extends('layouts.main')

@section('title', 'Buku Favorit Saya')

@section('content')
    <div class="page-header">
        <h1>Buku Favorit ❤️</h1>
        <p>Daftar buku yang telah Anda simpan.</p>
    </div>

    @if($favorites->isEmpty())
        <div style="text-align: center; padding: 4rem; color: var(--text-muted);">
            <div style="font-size: 4rem; margin-bottom: 1rem;">💔</div>
            <h3>Belum ada buku favorit</h3>
            <p>Jelajahi koleksi dan tekan tombol hati untuk menyimpan buku.</p>
            <a href="{{ route('books.collection') }}" style="display:inline-block; margin-top:1rem; padding:0.6rem 1.2rem; background:var(--primary); color:white; text-decoration:none; border-radius:0.5rem; font-weight:600;">Cari Buku</a>
        </div>
    @else
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 1.5rem;">
            @foreach($favorites as $book)
            <div class="card" style="padding: 0; overflow: hidden; margin-bottom: 0;">
                <div style="height: 200px; background: linear-gradient(135deg, var(--primary) 0%, #8b5cf6 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 3rem; font-weight: 700;">
                    @if($book->cover_image)
                        <img src="{{ asset('storage/' . $book->cover_image) }}" style="width: 100%; height: 100%; object-fit: cover;">
                    @else
                        {{ substr($book->title, 0, 1) }}
                    @endif
                </div>
                <div style="padding: 1rem;">
                    <h3 style="font-size: 1rem; margin-bottom: 0.3rem; font-weight: 700;">{{ $book->title }}</h3>
                    <p style="font-size: 0.8rem; color: var(--text-muted); margin-bottom: 1rem;">{{ $book->author }}</p>
                    
                    <form action="{{ route('favorites.toggle') }}" method="POST">
                        @csrf
                        <input type="hidden" name="book_id" value="{{ $book->id }}">
                        <button type="submit" style="width: 100%; padding: 0.5rem; background: var(--danger); color: white; border: none; border-radius: 0.5rem; cursor: pointer; font-weight: 600;">
                            Hapus Favorit 💔
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    @endif
@endsection