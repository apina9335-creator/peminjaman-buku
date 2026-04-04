<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Koleksi Buku - PinjamBuku</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700&display=swap" rel="stylesheet" />
    <style>
        /* === 1. KONFIGURASI WARNA (VARIABLES) === */
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

        /* === 2. STYLE DASAR === */
        * { margin: 0; padding: 0; box-sizing: border-box; transition: background-color 0.3s, color 0.3s, border-color 0.3s; }
        body { font-family: 'Instrument Sans', sans-serif; background: var(--bg-body); color: var(--text-main); line-height: 1.6; display: flex; }
        
        .sidebar { width: 280px; background: var(--bg-sidebar); color: white; padding: 2rem 1.5rem; position: fixed; height: 100vh; overflow-y: auto; z-index: 100; box-shadow: 4px 0 15px rgba(0,0,0,0.15); }
        .sidebar-header { display: flex; align-items: center; gap: 1rem; margin-bottom: 3rem; font-size: 1.5rem; font-weight: 700; }
        .sidebar-logo { width: 2.8rem; height: 2.8rem; background: rgba(255,255,255,0.25); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; font-weight: 700; }
        .sidebar-menu { list-style: none; }
        .sidebar-menu li { margin-bottom: 0.75rem; }
        .sidebar-menu a { display: flex; align-items: center; gap: 1rem; color: rgba(255,255,255,0.85); text-decoration: none; padding: 0.85rem 1rem; border-radius: 0.75rem; transition: all 0.3s ease; font-weight: 500; font-size: 0.95rem; }
        .sidebar-menu a:hover, .sidebar-menu a.active { background: rgba(255,255,255,0.2); color: white; transform: translateX(4px); }
        .sidebar-menu-icon { font-size: 1.3rem; width: 1.5rem; text-align: center; }
        
        .main-content { flex: 1; margin-left: 280px; min-height: 100vh; display: flex; flex-direction: column; }
        
        nav { background: var(--bg-card); box-shadow: 0 4px 12px var(--shadow); position: sticky; top: 0; z-index: 50; border-bottom: 1px solid var(--border-color); }
        nav .container { max-width: 1400px; margin: 0 auto; padding: 1.2rem 2rem; display: flex; justify-content: space-between; align-items: center; gap: 2rem; }
        .nav-left { display: flex; align-items: center; gap: 1rem; color: var(--text-main); font-weight: 600; }
        .user-menu { display: flex; align-items: center; gap: 2rem; }
        .user-info { display: flex; align-items: center; gap: 1rem; }
        .user-avatar { width: 3.2rem; height: 3.2rem; border-radius: 50%; background: var(--primary); color: white; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 1.3rem; }
        .user-details h4 { font-size: 1rem; color: var(--text-main); margin-bottom: 0.25rem; font-weight: 700; }
        .user-details p { font-size: 0.8rem; color: var(--text-muted); }
        
        .theme-toggle { background: var(--bg-card); border: 1px solid var(--border-color); color: var(--text-main); padding: 0.5rem; border-radius: 50%; cursor: pointer; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; box-shadow: 0 2px 5px var(--shadow); margin-right: 10px; }
        .theme-toggle:hover { transform: scale(1.1); }
        .logout-btn { padding: 0.75rem 1.5rem; background: linear-gradient(135deg, var(--danger) 0%, #dc2626 100%); color: white; border: none; border-radius: 0.75rem; cursor: pointer; font-weight: 600; transition: all 0.3s ease; text-decoration: none; font-size: 0.9rem; }

        .container { max-width: 1400px; margin: 0 auto; padding: 2.5rem; flex: 1; }
        .page-header { margin-bottom: 2.5rem; display: flex; justify-content: space-between; align-items: center; gap: 2rem; }
        .page-header h1 { font-size: 2.5rem; color: var(--text-main); margin-bottom: 0.5rem; font-weight: 700; }
        .page-header p { color: var(--text-muted); font-size: 1rem; }
        
        .search-box { display: flex; gap: 1rem; align-items: center; }
        .search-input { flex: 1; padding: 0.75rem 1.25rem; border: 2px solid var(--gray-300); border-radius: 0.75rem; font-size: 0.95rem; background: var(--input-bg); color: var(--text-main); font-family: inherit; }
        .search-input:focus { outline: none; border-color: var(--primary); }
        .filter-select { padding: 0.75rem 1.25rem; border: 2px solid var(--gray-300); border-radius: 0.75rem; background: var(--input-bg); color: var(--text-main); cursor: pointer; font-size: 0.95rem; font-family: inherit; }
        
        .stats-bar { background: var(--bg-card); padding: 1.5rem; border-radius: 1.2rem; margin-bottom: 2rem; display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 2rem; box-shadow: 0 4px 15px var(--shadow); border: 1px solid var(--border-color); }
        .stat-item { text-align: center; }
        .stat-item h4 { font-size: 2rem; color: var(--primary); margin-bottom: 0.5rem; font-weight: 700; }
        .stat-item p { color: var(--text-muted); font-size: 0.9rem; }

        .books-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 1.8rem; margin-bottom: 2rem; }
        .book-card { background: var(--bg-card); border-radius: 1.2rem; overflow: hidden; box-shadow: 0 4px 15px var(--shadow); transition: all 0.4s; border: 1px solid var(--border-color); display: flex; flex-direction: column; }
        .book-card:hover { transform: translateY(-12px); box-shadow: 0 20px 40px var(--shadow); }
        .book-cover { width: 100%; height: 260px; background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 5rem; font-weight: 700; position: relative; overflow: hidden; }
        
        .book-info { padding: 1.5rem; flex: 1; display: flex; flex-direction: column; }
        .book-info h3 { font-size: 1.05rem; color: var(--text-main); margin-bottom: 0.5rem; line-height: 1.5; font-weight: 700; }
        .book-author { font-size: 0.85rem; color: var(--text-muted); margin-bottom: 0.75rem; }
        .book-category { display: inline-block; background: var(--primary-light); color: var(--primary); padding: 0.3rem 0.8rem; border-radius: 0.5rem; font-size: 0.75rem; font-weight: 600; margin-bottom: 1rem; width: fit-content; }
        .book-rating { display: flex; align-items: center; gap: 0.4rem; font-size: 1.1rem; margin-bottom: 0.75rem; }
        
        .btn-borrow { width: 100%; padding: 0.75rem; border: none; border-radius: 0.75rem; color: white; font-weight: 600; cursor: pointer; transition: all 0.2s; font-size: 0.9rem; text-align: center; display: block; margin-top: 10px; }
        .btn-borrow.available { background: linear-gradient(135deg, var(--success) 0%, #059669 100%); }
        .btn-borrow.unavailable { background: var(--gray-200); color: var(--text-muted); cursor: not-allowed; }
        
        /* Tombol Spoiler Baru */
        .btn-spoiler { width: 100%; padding: 0.5rem; border: 1.5px solid var(--primary); border-radius: 0.5rem; color: var(--primary); background: transparent; font-weight: 600; cursor: pointer; transition: all 0.2s; font-size: 0.85rem; text-align: center; display: block; margin-top: 10px; }
        .btn-spoiler:hover { background: var(--primary-light); }

        .modal-overlay { position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.6); backdrop-filter: blur(4px); display: flex; align-items: center; justify-content: center; z-index: 1000; opacity: 0; pointer-events: none; transition: all 0.3s; }
        .modal-overlay.active { opacity: 1; pointer-events: all; }
        .modal-content { background: var(--bg-card); padding: 2rem; border-radius: 1.5rem; width: 90%; max-width: 450px; transform: translateY(20px); transition: all 0.3s; border: 1px solid var(--border-color); color: var(--text-main); }
        .modal-overlay.active .modal-content { transform: translateY(0); }
        .modal-title { font-size: 1.5rem; font-weight: 700; margin-bottom: 0.5rem; color: var(--text-main); }
        .modal-subtitle { color: var(--text-muted); font-size: 0.9rem; margin-bottom: 1.5rem; }
        
        /* CSS Khusus Untuk Area Teks Spoiler */
        .spoiler-text-area { background: var(--gray-100); padding: 1.5rem; border-radius: 1rem; border: 1px solid var(--gray-200); max-height: 350px; overflow-y: auto; font-size: 0.95rem; line-height: 1.7; white-space: pre-wrap; color: var(--text-main); margin-bottom: 1.5rem; text-align: justify; }

        .form-label { display: block; margin-bottom: 0.5rem; color: var(--text-main); font-weight: 600; font-size: 0.9rem; }
        .form-input { width: 100%; padding: 0.85rem 1rem; border: 2px solid var(--gray-300); border-radius: 0.75rem; font-family: inherit; font-size: 1rem; background: var(--input-bg); color: var(--text-main); }
        .modal-actions { display: flex; justify-content: flex-end; gap: 1rem; margin-top: 1rem; }
        .btn { padding: 0.75rem 1.5rem; border-radius: 0.75rem; font-weight: 600; border: none; cursor: pointer; }
        .btn-cancel { background: var(--gray-100); color: var(--text-main); }
        .btn-submit { background: var(--primary); color: white; }

        .star-rating { direction: rtl; display: inline-flex; }
        .star-rating input { display: none; }
        .star-rating label { font-size: 2rem; color: var(--gray-300); cursor: pointer; transition: 0.2s; }
        .star-rating input:checked ~ label { color: #f59e0b; }
        .star-rating label:hover, .star-rating label:hover ~ label { color: #f59e0b; }
    </style>
</head>
<body>
    <aside class="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo">📚</div>
            <span>PinjamBuku</span>
        </div>
        <ul class="sidebar-menu">
            <li><a href="{{ route('dashboard') }}"><span class="sidebar-menu-icon">🏠</span><span>Dashboard</span></a></li>
            <li><a href="{{ route('books.collection') }}" class="active"><span class="sidebar-menu-icon">📖</span><span>Koleksi Buku</span></a></li>
            <li><a href="{{ route('loans') }}"><span class="sidebar-menu-icon">📤</span><span>Peminjaman</span></a></li>
            <li><a href="/favorit"><span class="sidebar-menu-icon">❤️</span><span>Favorit</span></a></li>
            <li><a href="{{ route('history') }}"><span class="sidebar-menu-icon">📋</span><span>Riwayat</span></a></li>
            <li><a href="{{ route('settings') }}"><span class="sidebar-menu-icon">⚙️</span><span>Pengaturan</span></a></li>
        </ul>
    </aside>

    <div class="main-content">
        <nav>
            <div class="container">
                <div class="nav-left">🔔 Notifikasi</div>
                <div class="user-menu">
                    <button class="theme-toggle" onclick="toggleTheme()" id="themeBtn" title="Ganti Mode">🌙</button>

                    <div class="user-info">
                        <div class="user-avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                        <div class="user-details"><h4>{{ $user->name }}</h4><p>{{ $user->email }}</p></div>
                    </div>
                    <form action="/logout" method="POST" style="margin: 0;">
                        @csrf <button type="submit" class="logout-btn">Logout</button>
                    </form>
                </div>
            </div>
        </nav>

        <div class="container">
            @if(session('success'))
                <div style="background: rgba(16, 185, 129, 0.1); color: var(--success); padding: 1rem; border-radius: 0.5rem; margin-bottom: 1.5rem; border: 1px solid var(--success);">
                    ✅ <strong>Berhasil!</strong> {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div style="background: rgba(239, 68, 68, 0.1); color: var(--danger); padding: 1rem; border-radius: 0.5rem; margin-bottom: 1.5rem; border: 1px solid var(--danger);">
                    ❌ <strong>Gagal!</strong> {{ session('error') }}
                </div>
            @endif

            <div class="page-header">
                <div class="header-content">
                    <h1>Koleksi Buku 📚</h1>
                    <p>Jelajahi dan temukan buku favorit Anda</p>
                </div>
                <div class="search-box">
                    <input type="text" class="search-input" placeholder="Cari judul atau penulis..." id="searchInput">
                    <select class="filter-select" id="categoryFilter">
                        <option value="">Semua Kategori</option>
                        <option value="Novel">Novel</option>
                        <option value="Fantasy">Fantasy</option>
                        <option value="Science Fiction">Science Fiction</option>
                        <option value="Sejarah">Sejarah</option>
                        <option value="Teknologi">Teknologi</option>
                    </select>
                </div>
            </div>

            <div class="stats-bar">
                <div class="stat-item">
                    <h4>{{ $books->count() }}</h4>
                    <p>Total Buku</p>
                </div>
                <div class="stat-item">
                    <h4>{{ $books->filter(fn($b) => $b['available'])->count() }}</h4>
                    <p>Tersedia</p>
                </div>
                <div class="stat-item">
                    <h4>{{ $books->filter(fn($b) => !$b['available'])->count() }}</h4>
                    <p>Sedang Dipinjam</p>
                </div>
                <div class="stat-item">
                    <h4>{{ $books->pluck('category')->unique()->count() }}</h4>
                    <p>Kategori</p>
                </div>
            </div>

            <div class="books-grid">
                @foreach($books as $book)
                <div class="book-card" data-category="{{ $book['category'] }}" data-title="{{ strtolower($book['title']) }}" data-author="{{ strtolower($book['author']) }}">
                    <div class="book-cover">
                        @if($book['cover_image'])
                            <img src="{{ asset('storage/' . $book['cover_image']) }}" alt="{{ $book['title'] }}" style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            <div class="book-cover-content">{{ strtoupper(substr($book['title'], 0, 1)) }}</div>
                        @endif
                    </div>
                    <div class="book-info">
                        <h3>{{ $book['title'] }}</h3>
                        <p class="book-author">{{ $book['author'] }}</p>
                        <span class="book-category">{{ $book['category'] }}</span>
                        
                        <div class="book-rating" style="display: flex; justify-content: space-between; align-items: center;">
                            <div>
                                <span style="color: #f59e0b;">⭐ {{ $book['rating'] }}</span>
                                <span style="font-size: 0.8rem; color: var(--text-muted);">({{ $book['reviews'] }})</span>
                            </div>
                            <button onclick="openReviewModal('{{ $book['id'] }}', '{{ addslashes($book['title']) }}')" style="background: none; border: none; color: var(--primary); font-size: 0.8rem; cursor: pointer; text-decoration: underline;">
                                Tulis Ulasan
                            </button>
                        </div>

                        <form action="{{ route('favorites.toggle') }}" method="POST" style="display: flex; align-items: center; gap: 8px; margin-bottom: 10px; margin-top: 10px;">
                            @csrf
                            <input type="hidden" name="book_id" value="{{ $book['id'] }}">
                            @php
                                $isFav = Auth::user()->favorites->contains('id', $book['id']);
                            @endphp
                            <button type="submit" style="background: none; border: none; cursor: pointer; font-size: 1.5rem; transition: 0.2s; padding: 0;">
                                {{ $isFav ? '❤️' : '🤍' }} 
                            </button>
                            <span style="font-size: 0.8rem; color: var(--text-muted); cursor: pointer;" onclick="this.previousElementSibling.click()">
                                {{ $isFav ? 'Favorit' : 'Tambah ke Favorit' }}
                            </span>
                        </form>

                        {{-- DATA SPOILER DISEMBUNYIKAN UNTUK DIAMBIL OLEH JS NANTI --}}
                        <div id="spoiler-data-{{ $book['id'] }}" style="display: none;">{{ $book['spoiler'] ?? '' }}</div>

                        {{-- TOMBOL BACA CUPLIKAN (Hanya muncul jika admin sudah mengisi spoiler) --}}
                        @if(!empty($book['spoiler']))
                            <button onclick="openSpoilerModal('{{ $book['id'] }}', '{{ addslashes($book['title']) }}')" class="btn-spoiler">
                                👀 Baca Cuplikan
                            </button>
                        @endif

                        @if($book['available']) 
                            <button onclick="openModal('{{ $book['id'] }}', '{{ addslashes($book['title']) }}')" class="btn-borrow available">
                                📖 Pinjam Buku Ini
                            </button>
                        @else
                            <button disabled class="btn-borrow unavailable">
                                ❌ Sedang Dipinjam
                            </button>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- MODAL SPOILER BACAAN BUKU --}}
    <div id="spoilerModal" class="modal-overlay">
        <div class="modal-content" style="max-width: 600px;">
            <h2 class="modal-title">👀 Cuplikan Bacaan</h2>
            <p id="spoilerBookTitle" class="modal-subtitle" style="font-weight: bold; color: var(--primary);">Judul Buku</p>
            
            <div id="spoilerText" class="spoiler-text-area">
                </div>

            <div class="modal-actions">
                <button type="button" onclick="closeSpoilerModal()" class="btn btn-cancel" style="width: 100%;">Tutup</button>
            </div>
        </div>
    </div>

    {{-- MODAL PEMINJAMAN --}}
    <div id="loanModal" class="modal-overlay">
        <div class="modal-content">
            <h2 class="modal-title">Konfirmasi Peminjaman</h2>
            <p id="modalBookTitle" class="modal-subtitle">Judul Buku</p>
            
            <form action="{{ route('loans.store') }}" method="POST">
                @csrf
                <input type="hidden" name="book_id" id="modalBookId">
                <div class="form-group">
                    <label class="form-label">Durasi Peminjaman (Hari)</label>
                    <input type="number" name="duration" min="1" max="14" value="7" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Catatan (Opsional)</label>
                    <input type="text" name="notes" placeholder="Contoh: Untuk tugas sekolah" class="form-input">
                </div>
                <div class="modal-actions">
                    <button type="button" onclick="closeModal()" class="btn btn-cancel">Batal</button>
                    <button type="submit" class="btn btn-submit">Ajukan Pinjaman</button>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL ULASAN --}}
    <div id="reviewModal" class="modal-overlay">
        <div class="modal-content">
            <h2 class="modal-title">Berikan Ulasan</h2>
            <p id="reviewBookTitle" class="modal-subtitle">Judul Buku</p>
            
            <form action="{{ route('reviews.store') }}" method="POST">
                @csrf
                <input type="hidden" name="book_id" id="reviewBookId">
                <div class="form-group">
                    <label class="form-label">Rating</label>
                    <div class="star-rating">
                        <input type="radio" id="star5" name="rating" value="5" /><label for="star5">★</label>
                        <input type="radio" id="star4" name="rating" value="4" /><label for="star4">★</label>
                        <input type="radio" id="star3" name="rating" value="3" /><label for="star3">★</label>
                        <input type="radio" id="star2" name="rating" value="2" /><label for="star2">★</label>
                        <input type="radio" id="star1" name="rating" value="1" /><label for="star1">★</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Komentar</label>
                    <textarea name="comment" class="form-input" rows="3" placeholder="Bagaimana pendapatmu tentang buku ini?"></textarea>
                </div>
                <div class="modal-actions">
                    <button type="button" onclick="closeReviewModal()" class="btn btn-cancel">Batal</button>
                    <button type="submit" class="btn btn-submit">Kirim Ulasan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const html = document.documentElement;
        const themeBtn = document.getElementById('themeBtn');
        const savedTheme = localStorage.getItem('theme') || 'light';
        html.setAttribute('data-theme', savedTheme);
        updateIcon(savedTheme);

        function toggleTheme() {
            const currentTheme = html.getAttribute('data-theme');
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';
            html.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            updateIcon(newTheme);
        }
        function updateIcon(theme) { themeBtn.innerText = theme === 'dark' ? '☀️' : '🌙'; }

        // MENGATUR SEMUA MODAL
        const modal = document.getElementById('loanModal');
        const reviewModal = document.getElementById('reviewModal');
        const spoilerModal = document.getElementById('spoilerModal');
        
        // Modal Pinjam
        function openModal(id, title) {
            document.getElementById('modalBookId').value = id;
            document.getElementById('modalBookTitle').innerText = 'Meminjam: ' + title;
            modal.classList.add('active');
        }
        function closeModal() { modal.classList.remove('active'); }
        
        // Modal Ulasan
        function openReviewModal(id, title) {
            document.getElementById('reviewBookId').value = id;
            document.getElementById('reviewBookTitle').innerText = 'Mengulas: ' + title;
            reviewModal.classList.add('active');
        }
        function closeReviewModal() { reviewModal.classList.remove('active'); }

        // Modal Spoiler
        function openSpoilerModal(id, title) {
            let spoilerText = document.getElementById('spoiler-data-' + id).innerText;
            document.getElementById('spoilerBookTitle').innerText = title;
            document.getElementById('spoilerText').innerText = spoilerText;
            spoilerModal.classList.add('active');
        }
        function closeSpoilerModal() { spoilerModal.classList.remove('active'); }

        // Menutup modal jika klik di luar kotak
        window.onclick = function(e) {
            if (e.target == modal) closeModal();
            if (e.target == reviewModal) closeReviewModal();
            if (e.target == spoilerModal) closeSpoilerModal();
        }

        // Pencarian
        const searchInput = document.getElementById('searchInput');
        const categoryFilter = document.getElementById('categoryFilter');
        const bookCards = document.querySelectorAll('.book-card');

        function filterBooks() {
            const searchTerm = searchInput.value.toLowerCase();
            const selectedCategory = categoryFilter.value;
            bookCards.forEach(card => {
                const title = card.dataset.title;
                const author = card.dataset.author;
                const category = card.dataset.category;
                const matchesSearch = title.includes(searchTerm) || author.includes(searchTerm);
                const matchesCategory = selectedCategory === "" || category === selectedCategory;
                card.style.display = (matchesSearch && matchesCategory) ? "" : "none";
            });
        }
        searchInput.addEventListener('input', filterBooks);
        categoryFilter.addEventListener('change', filterBooks);
    </script>
</body>
</html>