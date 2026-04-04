<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - PinjamBuku</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700&display=swap" rel="stylesheet" />
    <style>
        /* === STYLE DASAR === */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --primary: #3b82f6; --primary-dark: #1e40af; --secondary: #8b5cf6;
            --success: #10b981; --warning: #f59e0b; --danger: #ef4444;
            --gray-100: #f3f4f6; --gray-800: #1f2937;
        }
        body { font-family: 'Instrument Sans', sans-serif; background: #f0f9ff; display: flex; color: var(--gray-800); }

        /* Sidebar */
        .sidebar { width: 280px; background: linear-gradient(180deg, var(--primary) 0%, var(--secondary) 100%); color: white; padding: 2rem 1.5rem; position: fixed; height: 100vh; overflow-y: auto; z-index: 100; }
        .sidebar-header { display: flex; align-items: center; gap: 1rem; margin-bottom: 3rem; font-size: 1.5rem; font-weight: 700; }
        .sidebar-logo { width: 2.8rem; height: 2.8rem; background: rgba(255,255,255,0.25); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; }
        .sidebar-menu { list-style: none; }
        .sidebar-menu li { margin-bottom: 0.75rem; }
        .sidebar-menu a { display: flex; align-items: center; gap: 1rem; color: rgba(255,255,255,0.85); text-decoration: none; padding: 0.85rem 1rem; border-radius: 0.75rem; transition: 0.3s; font-weight: 500; }
        .sidebar-menu a:hover, .sidebar-menu a.active { background: rgba(255,255,255,0.2); color: white; transform: translateX(4px); }
        .sidebar-menu-icon { width: 1.5rem; text-align: center; }

        /* Main Content */
        .main-content { flex: 1; margin-left: 280px; padding: 2rem; min-height: 100vh; }
        
        /* Navbar Simple */
        .top-bar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2.5rem; }
        .user-profile { display: flex; align-items: center; gap: 1rem; }
        .avatar { width: 40px; height: 40px; background: var(--primary); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; }
        
        /* Box Umum / Card */
        .card { background: white; padding: 1.5rem; border-radius: 1rem; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }

        /* Hero Section */
        .hero-card { background: white; padding: 2rem; border-radius: 1.5rem; box-shadow: 0 4px 6px rgba(0,0,0,0.05); margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: center; }
        .hero-text h1 { font-size: 1.8rem; margin-bottom: 0.5rem; color: var(--gray-800); }
        .hero-text p { color: #6b7280; }
        .btn-primary { background: var(--primary); color: white; padding: 0.75rem 1.5rem; border-radius: 0.75rem; text-decoration: none; font-weight: 600; display: inline-block; margin-top: 1rem; transition: 0.2s; }
        .btn-primary:hover { background: var(--primary-dark); }

        /* Stats Grid */
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1.5rem; margin-bottom: 3rem; }
        .stat-card { background: white; padding: 1.5rem; border-radius: 1rem; box-shadow: 0 2px 4px rgba(0,0,0,0.05); display: flex; flex-direction: column; }
        .stat-icon { font-size: 2rem; margin-bottom: 1rem; }
        .stat-value { font-size: 2.5rem; font-weight: 700; color: var(--gray-800); }
        .stat-label { color: #6b7280; font-size: 0.9rem; }

        /* Section Title */
        .section-title { font-size: 1.25rem; font-weight: 700; margin-bottom: 1.5rem; display: flex; justify-content: space-between; align-items: center; margin-top: 2rem; }
        .view-all { font-size: 0.9rem; color: var(--primary); text-decoration: none; }

        /* Active Loans List */
        .loans-list { display: flex; flex-direction: column; gap: 1rem; margin-bottom: 3rem; }
        .loan-item { background: white; padding: 1rem; border-radius: 1rem; display: flex; align-items: center; gap: 1rem; border-left: 5px solid var(--warning); box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
        .loan-info h4 { font-size: 1rem; margin-bottom: 0.2rem; }
        .loan-info p { font-size: 0.85rem; color: #6b7280; }
        .loan-date { margin-left: auto; text-align: right; font-size: 0.85rem; }
        .badge-due { background: #fef3c7; color: #d97706; padding: 0.3rem 0.8rem; border-radius: 2rem; font-size: 0.8rem; font-weight: 600; }

        /* New Books Grid */
        .books-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 1.5rem; margin-bottom: 2rem; }
        .book-card { background: white; border-radius: 1rem; overflow: hidden; box-shadow: 0 2px 4px rgba(0,0,0,0.05); transition: 0.3s; }
        .book-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
        .book-cover { height: 200px; background: #e5e7eb; display: flex; align-items: center; justify-content: center; font-size: 2rem; color: #9ca3af; }
        .book-cover img { width: 100%; height: 100%; object-fit: cover; }
        .book-details { padding: 1rem; }
        .book-title { font-weight: 700; font-size: 0.95rem; margin-bottom: 0.3rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .book-author { font-size: 0.8rem; color: #6b7280; }
    </style>
</head>
<body>

    <aside class="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo">📚</div>
            <span>PinjamBuku</span>
        </div>
        <ul class="sidebar-menu">
            <li><a href="{{ route('dashboard') }}" class="active"><span class="sidebar-menu-icon">🏠</span><span>Dashboard</span></a></li>
            <li><a href="{{ route('books.collection') }}"><span class="sidebar-menu-icon">📖</span><span>Koleksi Buku</span></a></li>
            <li><a href="{{ route('loans') }}"><span class="sidebar-menu-icon">📤</span><span>Peminjaman</span></a></li>
            <li><a href="/favorit"><span class="sidebar-menu-icon">❤️</span><span>Favorit</span></a></li>
            <li><a href="{{ route('history') }}"><span class="sidebar-menu-icon">📋</span><span>Riwayat</span></a></li>
            <li><a href="{{ route('settings') }}"><span class="sidebar-menu-icon">⚙️</span><span>Pengaturan</span></a></li>
        </ul>
    </aside>

    <div class="main-content">
        
        <div class="top-bar">
            <h2>Dashboard</h2>
            <div class="user-profile">
                <span>Halo, <strong>{{ $user->name }}</strong></span>
                <div class="avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
            </div>
        </div>

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
                <div class="stat-icon">📤</div>
                <div class="stat-value" style="color: var(--warning);">{{ $stats['active_loans'] ?? 0 }}</div>
                <div class="stat-label">Sedang Dipinjam</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">❤️</div>
                <div class="stat-value" style="color: var(--danger);">{{ $stats['favorites'] ?? 0 }}</div>
                <div class="stat-label">Buku Favorit</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">✅</div>
                <div class="stat-value" style="color: var(--success);">{{ $stats['total_returned'] ?? 0 }}</div>
                <div class="stat-label">Buku Dikembalikan</div>
            </div>
        </div>

        <div class="card" style="margin-bottom: 2rem;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                <h2 style="font-size: 1.25rem; font-weight: 700;">📊 Statistik Membaca Anda (Tahun Ini)</h2>
            </div>
            <div style="position: relative; height: 300px; width: 100%;">
                <canvas id="readingChart"></canvas>
            </div>
        </div>

        @if(isset($activeLoans) && $activeLoans->count() > 0)
        <div class="section-title">
            <span>⚠️ Jangan Lupa Dikembalikan</span>
            <a href="{{ route('loans') }}" class="view-all">Lihat Semua</a>
        </div>
        <div class="loans-list">
            @foreach($activeLoans as $loan)
            <div class="loan-item">
                <div style="font-size: 2rem;">📖</div>
                <div class="loan-info">
                    <h4>{{ $loan->book->title }}</h4>
                    <p>Dipinjam: {{ \Carbon\Carbon::parse($loan->borrow_date)->format('d M Y') }}</p>
                </div>
                <div class="loan-date">
                    <span class="badge-due">Tenggat: {{ \Carbon\Carbon::parse($loan->return_date)->format('d M Y') }}</span>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        @if(isset($newBooks))
        <div class="section-title">
            <span>🔥 Buku Terbaru</span>
            <a href="{{ route('books.collection') }}" class="view-all">Lihat Semua</a>
        </div>
        <div class="books-grid">
            @foreach($newBooks as $book)
            <a href="{{ route('books.collection') }}" style="text-decoration: none; color: inherit;">
                <div class="book-card">
                    <div class="book-cover">
                        @if($book->cover_image)
                            <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}">
                        @else
                            <span>{{ substr($book->title, 0, 1) }}</span>
                        @endif
                    </div>
                    <div class="book-details">
                        <div class="book-title">{{ $book->title }}</div>
                        <div class="book-author">{{ $book->author }}</div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        @endif

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const ctx = document.getElementById('readingChart').getContext('2d');
            
            // PERBAIKAN: Menggunakan {!! json_encode() !!} murni agar tidak error Parse
            const monthlyData = {!! json_encode($monthlyLoans ?? [0,0,0,0,0,0,0,0,0,0,0,0]) !!};

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                    datasets: [{
                        label: 'Jumlah Buku Dipinjam',
                        data: monthlyData,
                        backgroundColor: 'rgba(59, 130, 246, 0.8)',
                        borderColor: 'rgb(37, 99, 235)',
                        borderWidth: 1,
                        borderRadius: 6, 
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { labels: { font: { family: "'Instrument Sans', sans-serif" } } }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { stepSize: 1 } 
                        },
                        x: {
                            grid: { display: false } 
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>