<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Buku - PinjamBuku</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700&display=swap" rel="stylesheet" />
    <style>
        /* === KONFIGURASI WARNA === */
        :root {
            --bg-body: linear-gradient(135deg, #f0f9ff 0%, #f5f3ff 100%);
            --bg-card: #ffffff;
            --bg-sidebar: linear-gradient(180deg, #3b82f6 0%, #8b5cf6 100%);
            --text-main: #1f2937;
            --text-muted: #6b7280;
            --border-color: #e5e7eb;
            --shadow: rgba(0,0,0,0.06);
            --input-bg: #ffffff;
            
            --primary: #3b82f6; 
            --primary-light: #dbeafe;
            --primary-dark: #1e40af;
            --danger: #ef4444; 
            --success: #10b981;
            --warning: #f59e0b;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
        }

        [data-theme="dark"] {
            --bg-body: #0f172a;       
            --bg-card: #1e293b;       
            --bg-sidebar: linear-gradient(180deg, #1e3a8a 0%, #5b21b6 100%);
            --text-main: #f1f5f9;     
            --text-muted: #94a3b8;    
            --border-color: #334155;
            --shadow: rgba(0,0,0,0.3);
            --input-bg: #0f172a;
            
            --primary-light: #1e3a8a;
            --gray-100: #334155;
            --gray-200: #334155;
            --gray-300: #475569;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; transition: background-color 0.3s, color 0.3s, border-color 0.3s; }
        body { font-family: 'Instrument Sans', sans-serif; background: var(--bg-body); color: var(--text-main); line-height: 1.6; display: flex; }
        
        .sidebar { width: 280px; background: var(--bg-sidebar); color: white; padding: 2rem 1.5rem; position: fixed; height: 100vh; z-index: 100; box-shadow: 4px 0 15px rgba(0,0,0,0.15); }
        .sidebar-header { display: flex; align-items: center; gap: 1rem; margin-bottom: 3rem; font-size: 1.5rem; font-weight: 700; }
        .sidebar-logo { width: 2.8rem; height: 2.8rem; background: rgba(255,255,255,0.25); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; }
        .sidebar-menu { list-style: none; }
        .sidebar-menu li { margin-bottom: 0.75rem; }
        .sidebar-menu a { display: flex; align-items: center; gap: 1rem; color: rgba(255,255,255,0.85); text-decoration: none; padding: 0.85rem 1rem; border-radius: 0.75rem; font-weight: 500; transition: 0.3s; }
        .sidebar-menu a:hover, .sidebar-menu a.active { background: rgba(255,255,255,0.2); color: white; transform: translateX(4px); }
        
        .main-content { flex: 1; margin-left: 280px; padding: 2rem 3rem; min-height: 100vh; }
        
        .top-bar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem; }
        .back-btn { text-decoration: none; color: var(--text-main); font-weight: 600; display: flex; align-items: center; gap: 0.5rem; padding: 0.5rem 1rem; background: var(--bg-card); border-radius: 2rem; box-shadow: 0 2px 10px var(--shadow); transition: 0.2s; border: 1px solid var(--border-color); white-space: nowrap; }
        .back-btn:hover { background: var(--gray-100); transform: translateX(-3px); }
        
        .user-profile-badge { display: flex; align-items: center; gap: 0.8rem; background: var(--bg-card); padding: 0.4rem 1.2rem 0.4rem 0.4rem; border-radius: 2rem; box-shadow: 0 2px 10px var(--shadow); border: 1px solid var(--border-color); }
        .avatar-small { width: 35px; height: 35px; background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 0.9rem; flex-shrink: 0; }
        .user-name-text { color: var(--text-main); font-weight: 700; font-size: 0.95rem; white-space: nowrap; }

        .card { background: var(--bg-card); padding: 2.5rem; border-radius: 1.5rem; box-shadow: 0 4px 20px var(--shadow); margin-bottom: 3rem; border: 1px solid var(--border-color); }
        .detail-grid { display: grid; grid-template-columns: 320px 1fr; gap: 3.5rem; align-items: start; }
        
        .book-cover { width: 100%; height: 480px; border-radius: 1.2rem; background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); display: flex; align-items: center; justify-content: center; font-size: 6rem; color: white; font-weight: 700; overflow: hidden; box-shadow: 0 10px 30px var(--shadow); }
        .book-cover img { width: 100%; height: 100%; object-fit: cover; }
        
        .badge { display: inline-block; background: var(--primary-light); color: var(--primary); padding: 0.4rem 1.2rem; border-radius: 2rem; font-size: 0.85rem; font-weight: 700; margin-bottom: 1.2rem; border: 1px solid rgba(59, 130, 246, 0.2); }
        .book-title { font-size: 2.8rem; margin-bottom: 0.8rem; line-height: 1.15; color: var(--text-main); font-weight: 800; }
        .book-author { font-size: 1.15rem; color: var(--text-muted); margin-bottom: 2rem; }
        
        .stats-box { display: flex; gap: 3rem; margin-bottom: 2.5rem; padding: 1.5rem 2rem; background: var(--gray-100); border-radius: 1.2rem; border: 1px solid var(--border-color); flex-wrap: wrap; }
        .stats-item { display: flex; flex-direction: column; gap: 0.3rem; }
        .stats-label { font-size: 0.8rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px; font-weight: 600; }
        .stats-value { font-size: 1.4rem; font-weight: 700; color: var(--text-main); display: flex; align-items: center; gap: 0.5rem; }
        
        .btn { display: block; width: 100%; text-align: center; padding: 1.1rem; border-radius: 1rem; font-weight: 700; text-decoration: none; transition: 0.3s; border: none; cursor: pointer; font-size: 1.05rem; }
        .btn-primary { background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); color: white; margin-top: 2rem; box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4); }
        .btn-primary:hover { transform: translateY(-3px); box-shadow: 0 8px 25px rgba(59, 130, 246, 0.5); }
        
        .section-title { font-size: 1.3rem; font-weight: 700; margin-bottom: 1rem; color: var(--text-main); }
        .sinopsis-text { line-height: 1.8; color: var(--text-main); margin-bottom: 2rem; text-align: justify; font-size: 1.05rem; }
        .spoiler-box { background: rgba(245, 158, 11, 0.1); border-left: 4px solid var(--warning); padding: 1.5rem; border-radius: 0 1rem 1rem 0; margin-top: 2rem; }
        .spoiler-box h4 { color: #d97706; margin-bottom: 0.8rem; display: flex; align-items: center; gap: 0.5rem; }
        
        .recom-header { margin-bottom: 1.5rem; margin-top: 1rem; color: var(--text-main); font-size: 1.5rem; font-weight: 700; }
        .recom-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1.8rem; margin-bottom: 3rem; }
        .recom-card { background: var(--bg-card); border-radius: 1.2rem; overflow: hidden; box-shadow: 0 4px 15px var(--shadow); transition: 0.3s; text-decoration: none; color: var(--text-main); border: 1px solid var(--border-color); display: flex; flex-direction: column; }
        .recom-card:hover { transform: translateY(-8px); box-shadow: 0 15px 30px var(--shadow); border-color: var(--primary); }
        .recom-cover { height: 240px; background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); display: flex; align-items: center; justify-content: center; font-size: 3.5rem; color: white; font-weight: 700; }
        .recom-cover img { width: 100%; height: 100%; object-fit: cover; }
        .recom-info { padding: 1.2rem; }
        .recom-info h4 { font-size: 1rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; margin-bottom: 0.3rem; }
        
        /* ULASAN KOMUNITAS */
        .review-item { padding: 1.5rem 0; border-bottom: 1px solid var(--border-color); }
        .review-item:last-child { border-bottom: none; }
        .review-header { display: flex; justify-content: space-between; margin-bottom: 0.8rem; align-items: center; }
        .reviewer-name { font-weight: 700; color: var(--text-main); display: flex; align-items: center; gap: 0.5rem; }
        .review-text { color: var(--text-main); line-height: 1.6; margin-top: 0.5rem; }
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
            <li><a href="{{ route('history') }}">📋<span>Riwayat</span></a></li>
            <li><a href="{{ route('settings') }}">⚙️<span>Pengaturan</span></a></li>
        </ul>
    </aside>

    <div class="main-content">
        
        <div class="top-bar">
            <a href="{{ route('books.collection') }}" class="back-btn">
                <span>⬅️</span> Kembali ke Koleksi
            </a>
            
            <div class="user-profile-badge">
                <div class="avatar-small">
                    @if(Auth::user()->avatar)
                        <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Profile" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                    @else
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    @endif
                </div>
                <span class="user-name-text">{{ $user->name }}</span>
            </div>
        </div>

        @if(session('success'))
            <div style="background: rgba(16, 185, 129, 0.1); color: var(--success); padding: 1rem; border-radius: 0.5rem; margin-bottom: 1.5rem; border: 1px solid var(--success);">
                ✅ <strong>Berhasil!</strong> {{ session('success') }}
            </div>
        @endif

        <div class="card detail-grid">
            <div>
                <div class="book-cover">
                    @if($book->cover_image)
                        <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}">
                    @else
                        <span>{{ strtoupper(substr($book->title, 0, 1)) }}</span>
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
                    <button class="btn" style="background: var(--gray-200); color: var(--text-muted); margin-top: 2rem; cursor: not-allowed;" disabled>❌ Stok Habis</button>
                @endif
            </div>

            <div style="display: flex; flex-direction: column;">
                <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                    <div>
                        <span class="badge">{{ $book->category ?? 'Umum' }}</span>
                        <h1 class="book-title">{{ $book->title }}</h1>
                        <p class="book-author">Ditulis oleh: <strong>{{ $book->author }}</strong></p>
                    </div>
                </div>
                
                <div class="stats-box">
                    <div class="stats-item">
                        <span class="stats-label">Stok Tersedia</span>
                        <span class="stats-value">📚 {{ $book->stock }}</span>
                    </div>
                    <div class="stats-item">
                        <span class="stats-label">Rating Komunitas</span>
                        <span class="stats-value" style="color: var(--warning);">
                            ⭐ {{ number_format($book->reviews->avg('rating'), 1) ?: '0' }}
                        </span>
                    </div>
                    <div class="stats-item">
                        <span class="stats-label">Total Ulasan</span>
                        <span class="stats-value">💬 {{ $book->reviews->count() }}</span>
                    </div>
                </div>

                <h3 class="section-title">Sinopsis Singkat</h3>
                <p class="sinopsis-text">
                    {{ $book->description ?? 'Belum ada deskripsi untuk buku ini. Silakan hubungi admin untuk melengkapinya.' }}
                </p>

                @if(!empty($book->spoiler))
                    <div class="spoiler-box">
                        <h4>👀 Cuplikan Bacaan Eksklusif</h4>
                        <p style="font-size: 0.95rem; font-style: italic; color: var(--text-main);">"{{ Str::limit($book->spoiler, 250) }}"</p>
                    </div>
                @endif
            </div>
        </div>

        @if($recommendations->count() > 0)
        <h2 class="recom-header">✨ Mungkin Anda juga suka...</h2>
        <div class="recom-grid">
            @foreach($recommendations as $recom)
            <a href="{{ route('books.show', $recom->id) }}" class="recom-card">
                <div class="recom-cover">
                    @if($recom->cover_image)
                        <img src="{{ asset('storage/' . $recom->cover_image) }}" alt="">
                    @else
                        <span>{{ strtoupper(substr($recom->title, 0, 1)) }}</span>
                    @endif
                </div>
                <div class="recom-info">
                    <h4>{{ $recom->title }}</h4>
                    <p style="font-size: 0.85rem; color: var(--text-muted);">{{ $recom->author }}</p>
                </div>
            </a>
            @endforeach
        </div>
        @endif

        <div class="card" style="margin-top: 1rem;">
            <h2 style="margin-bottom: 1.5rem; color: var(--text-main);">💬 Diskusi & Ulasan Komunitas</h2>
            @if($book->reviews->count() > 0)
                @foreach($book->reviews as $review)
                <div class="review-item">
                    
                    <div class="review-header">
                        <div class="reviewer">
                            <a href="{{ route('user.show', $review->user->id) }}" style="display: flex; align-items: center; gap: 0.8rem; text-decoration: none; color: inherit; cursor: pointer;">
                                <div class="review-avatar" style="overflow: hidden; width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); color: white; display: flex; align-items: center; justify-content: center; font-weight: bold; flex-shrink: 0;">
                                    @if($review->user->avatar)
                                        <img src="{{ asset('storage/' . $review->user->avatar) }}" style="width: 100%; height: 100%; object-fit: cover;">
                                    @else
                                        {{ strtoupper(substr($review->user->name, 0, 1)) }}
                                    @endif
                                </div>
                                <strong style="font-size: 1.1rem; transition: 0.2s;" onmouseover="this.style.color='var(--primary)'" onmouseout="this.style.color='inherit'">{{ $review->user->name }}</strong>
                            </a>
                        </div>
                        <span style="color: var(--warning); font-weight: 700;">{{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}</span>
                    </div>

                    <p class="review-text">{{ $review->comment }}</p>
                    
                    <div class="review-actions" style="display: flex; gap: 1.5rem; align-items: center; margin-top: 1rem;">
                        <form action="{{ route('reviews.like', $review->id) }}" method="POST" style="margin: 0;">
                            @csrf
                            @php
                                $hasLiked = $review->likes->contains('user_id', Auth::id());
                            @endphp
                            <button type="submit" style="background: none; border: none; cursor: pointer; font-size: 0.9rem; font-weight: 600; color: {{ $hasLiked ? 'var(--danger)' : 'var(--text-muted)' }}; transition: 0.2s; padding: 0;">
                                {{ $hasLiked ? '❤️' : '🤍' }} Suka ({{ $review->likes->count() }})
                            </button>
                        </form>

                        <button onclick="toggleReplyForm({{ $review->id }})" style="background: none; border: none; cursor: pointer; font-size: 0.9rem; font-weight: 600; color: var(--primary); padding: 0;">
                            ↩️ Balas ({{ $review->replies->count() }})
                        </button>
                    </div>

                    @if($review->replies->count() > 0)
                        <div style="margin-top: 1.5rem; margin-left: 2rem; padding-left: 1.5rem; border-left: 2px solid var(--border-color);">
                            @foreach($review->replies as $reply)
                                <div style="margin-bottom: 1rem;">
                                    <div style="display: flex; align-items: center; gap: 0.8rem; margin-bottom: 0.4rem;">
                                        <a href="{{ route('user.show', $reply->user->id) }}" style="display: flex; align-items: center; gap: 0.5rem; text-decoration: none; color: inherit;">
                                            <div style="width: 24px; height: 24px; border-radius: 50%; background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); color: white; font-size: 0.7rem; display: flex; align-items: center; justify-content: center; font-weight: bold; overflow: hidden; flex-shrink: 0;">
                                                @if($reply->user->avatar)
                                                    <img src="{{ asset('storage/' . $reply->user->avatar) }}" style="width: 100%; height: 100%; object-fit: cover;">
                                                @else
                                                    {{ strtoupper(substr($reply->user->name, 0, 1)) }}
                                                @endif
                                            </div>
                                            <strong style="font-size: 0.9rem; transition: 0.2s;" onmouseover="this.style.color='var(--primary)'" onmouseout="this.style.color='inherit'">{{ $reply->user->name }}</strong>
                                        </a>
                                        <span style="font-size: 0.75rem; color: var(--text-muted);">• {{ $reply->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p style="font-size: 0.95rem; color: var(--text-main); margin-left: 2.3rem;">{{ $reply->reply_text }}</p>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <div id="reply-form-{{ $review->id }}" style="display: none; margin-top: 1.5rem; margin-left: 2rem;">
                        <form action="{{ route('reviews.reply', $review->id) }}" method="POST" style="display: flex; gap: 0.8rem;">
                            @csrf
                            <input type="text" name="reply_text" placeholder="Tulis balasanmu..." required style="flex: 1; padding: 0.8rem 1.2rem; border: 1px solid var(--border-color); border-radius: 2rem; font-size: 0.95rem; font-family: inherit; outline: none; background: var(--input-bg); color: var(--text-main);">
                            <button type="submit" style="background: var(--primary); color: white; border: none; padding: 0 1.5rem; border-radius: 2rem; font-weight: 600; cursor: pointer; transition: 0.2s;">Kirim</button>
                        </form>
                    </div>

                </div>
                @endforeach
            @else
                <p style="color: var(--text-muted); font-style: italic; padding: 1rem 0;">Belum ada yang memberikan ulasan. Jadilah yang pertama meminjam dan mengulas buku ini!</p>
            @endif
        </div>
    </div>

    <script>
        const savedTheme = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-theme', savedTheme);

        function toggleReplyForm(reviewId) {
            const form = document.getElementById('reply-form-' + reviewId);
            if (form.style.display === 'none' || form.style.display === '') {
                form.style.display = 'block';
            } else {
                form.style.display = 'none';
            }
        }
    </script>
</body>
</html>