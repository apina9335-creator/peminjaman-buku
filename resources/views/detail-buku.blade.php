<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Buku - PinjamBuku</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700&display=swap" rel="stylesheet" />
    <style>
        /* CSS Dasar & Sidebar (Sama dengan Dashboard) */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root { --primary: #3b82f6; --primary-dark: #1e40af; --secondary: #8b5cf6; --gray-100: #f3f4f6; --gray-200: #e5e7eb; --gray-800: #1f2937; }
        body { font-family: 'Instrument Sans', sans-serif; background: #f0f9ff; display: flex; color: var(--gray-800); }
        .sidebar { width: 280px; background: linear-gradient(180deg, var(--primary) 0%, var(--secondary) 100%); color: white; padding: 2rem 1.5rem; position: fixed; height: 100vh; z-index: 100; }
        .sidebar-header { display: flex; align-items: center; gap: 1rem; margin-bottom: 3rem; font-size: 1.5rem; font-weight: 700; }
        .sidebar-logo { width: 2.8rem; height: 2.8rem; background: rgba(255,255,255,0.25); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; }
        .sidebar-menu { list-style: none; }
        .sidebar-menu li { margin-bottom: 0.75rem; }
        .sidebar-menu a { display: flex; align-items: center; gap: 1rem; color: rgba(255,255,255,0.85); text-decoration: none; padding: 0.85rem 1rem; border-radius: 0.75rem; font-weight: 500; }
        .sidebar-menu a:hover, .sidebar-menu a.active { background: rgba(255,255,255,0.2); color: white; }
        
        .main-content { flex: 1; margin-left: 280px; padding: 2rem; min-height: 100vh; }
        .top-bar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; }
        .card { background: white; padding: 2rem; border-radius: 1.5rem; box-shadow: 0 4px 15px rgba(0,0,0,0.05); margin-bottom: 2rem; }
        
        /* Layout Detail */
        .detail-grid { display: grid; grid-template-columns: 300px 1fr; gap: 3rem; }
        .book-cover { width: 100%; height: 450px; border-radius: 1rem; background: #e5e7eb; display: flex; align-items: center; justify-content: center; font-size: 4rem; overflow: hidden; box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
        .book-cover img { width: 100%; height: 100%; object-fit: cover; }
        .badge { display: inline-block; background: #dbeafe; color: var(--primary-dark); padding: 0.4rem 1rem; border-radius: 2rem; font-size: 0.85rem; font-weight: 700; margin-bottom: 1rem; }
        .btn { display: block; width: 100%; text-align: center; padding: 1rem; border-radius: 0.75rem; font-weight: 700; text-decoration: none; transition: 0.2s; border: none; cursor: pointer; }
        .btn-primary { background: var(--primary); color: white; margin-top: 1.5rem; }
        .btn-primary:hover { background: var(--primary-dark); }
        
        /* Ulasan */
        .review-item { padding: 1.5rem 0; border-bottom: 1px solid var(--gray-200); }
        .review-item:last-child { border-bottom: none; }
        
        /* Rekomendasi */
        .recom-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.5rem; }
        .recom-card { background: white; border-radius: 1rem; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.05); transition: 0.3s; text-decoration: none; color: inherit; }
        .recom-card:hover { transform: translateY(-5px); }
        .recom-cover { height: 200px; background: #e5e7eb; }
        .recom-cover img { width: 100%; height: 100%; object-fit: cover; }
    </style>
</head>
<body>
    <aside class="sidebar">
        <div class="sidebar-header"><div class="sidebar-logo">📚</div><span>PinjamBuku</span></div>
        <ul class="sidebar-menu">
            <li><a href="{{ route('dashboard') }}">🏠<span>Dashboard</span></a></li>
            <li><a href="{{ route('books.collection') }}" class="active">📖<span>Koleksi Buku</span></a></li>
            <li><a href="{{ route('loans') }}">📤<span>Peminjaman</span></a></li>
            <li><a href="/favorit">❤️<span>Favorit</span></a></li>
        </ul>
    </aside>

    <div class="main-content">
        <div class="top-bar">
            <a href="{{ route('books.collection') }}" style="text-decoration: none; color: var(--gray-800); font-weight: 600;">⬅️ Kembali ke Koleksi</a>
            <div style="display: flex; align-items: center; gap: 1rem;">
                <strong>{{ $user->name }}</strong>
            </div>
        </div>

        <div class="card detail-grid">
            <div>
                <div class="book-cover">
                    @if($book->cover_image)
                        <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}">
                    @else
                        <span>{{ substr($book->title, 0, 1) }}</span>
                    @endif
                </div>
                
                @if($book->stock > 0)
                    <form action="{{ route('loans.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="book_id" value="{{ $book->id }}">
                        <input type="hidden" name="duration" value="7">
                        <button type="submit" class="btn btn-primary">📖 Pinjam Buku Ini (7 Hari)</button>
                    </form>
                @else
                    <button class="btn" style="background: var(--gray-200); color: var(--gray-800); margin-top: 1.5rem; cursor: not-allowed;" disabled>❌ Stok Habis</button>
                @endif
            </div>

            <div>
                <span class="badge">{{ $book->category ?? 'Umum' }}</span>
                <h1 style="font-size: 2.5rem; margin-bottom: 0.5rem; line-height: 1.2;">{{ $book->title }}</h1>
                <p style="font-size: 1.1rem; color: #6b7280; margin-bottom: 1.5rem;">Karya: <strong>{{ $book->author }}</strong></p>
                
                <div style="display: flex; gap: 2rem; margin-bottom: 2rem; padding: 1rem; background: var(--gray-100); border-radius: 1rem;">
                    <div><strong>Stok:</strong> {{ $book->stock }} Buku</div>
                    <div><strong>Rating:</strong> ⭐ {{ number_format($book->reviews->avg('rating'), 1) ?: '0' }}</div>
                    <div><strong>Ulasan:</strong> {{ $book->reviews->count() }}</div>
                </div>

                <h3 style="margin-bottom: 0.5rem;">Sinopsis Singkat</h3>
                <p style="line-height: 1.8; color: var(--gray-800); margin-bottom: 2rem; text-align: justify;">
                    {{ $book->description ?? 'Belum ada deskripsi untuk buku ini.' }}
                </p>

                @if(!empty($book->spoiler))
                    <div style="background: #fef3c7; border-left: 4px solid #f59e0b; padding: 1rem; border-radius: 0.5rem;">
                        <h4 style="color: #d97706; margin-bottom: 0.5rem;">👀 Cuplikan Bacaan</h4>
                        <p style="font-size: 0.9rem; font-style: italic;">"{{ Str::limit($book->spoiler, 150) }}"</p>
                    </div>
                @endif
            </div>
        </div>

        @if($recommendations->count() > 0)
        <h2 style="margin-bottom: 1.5rem; margin-top: 3rem;">✨ Mungkin Anda juga suka...</h2>
        <div class="recom-grid" style="margin-bottom: 3rem;">
            @foreach($recommendations as $recom)
            <a href="{{ route('books.show', $recom->id) }}" class="recom-card">
                <div class="recom-cover">
                    @if($recom->cover_image)
                        <img src="{{ asset('storage/' . $recom->cover_image) }}" alt="">
                    @else
                        <div style="height: 100%; display: flex; align-items: center; justify-content: center; font-size: 2rem;">{{ substr($recom->title, 0, 1) }}</div>
                    @endif
                </div>
                <div style="padding: 1rem;">
                    <h4 style="font-size: 0.95rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $recom->title }}</h4>
                    <p style="font-size: 0.8rem; color: #6b7280;">{{ $recom->author }}</p>
                </div>
            </a>
            @endforeach
        </div>
        @endif

        <div class="card">
            <h2 style="margin-bottom: 1.5rem;">💬 Diskusi & Ulasan Komunitas</h2>
            @if($book->reviews->count() > 0)
                @foreach($book->reviews as $review)
                <div class="review-item">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                        <strong>{{ $review->user->name }}</strong>
                        <span style="color: #f59e0b;">
                            {{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}
                        </span>
                    </div>
                    <p style="color: var(--gray-800);">{{ $review->comment }}</p>
                    <div style="margin-top: 0.8rem; font-size: 0.85rem; color: #3b82f6; cursor: pointer;">
                        ❤️ Suka (0) &nbsp; ↩️ Balas
                    </div>
                </div>
                @endforeach
            @else
                <p style="color: #6b7280; font-style: italic;">Jadilah yang pertama mengulas buku ini!</p>
            @endif
        </div>
    </div>
</body>
</html>