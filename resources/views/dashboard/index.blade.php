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

        /* Main Content */
        .main-content { flex: 1; margin-left: 280px; padding: 2rem; min-height: 100vh; }
        
        /* Top Bar */
        .top-bar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2.5rem; }
        .user-profile { display: flex; align-items: center; gap: 1rem; background: white; padding: 0.5rem 1.2rem; border-radius: 3rem; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .avatar { width: 40px; height: 40px; background: var(--primary); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; overflow: hidden; flex-shrink: 0; }
        
        .card { background: white; padding: 1.5rem; border-radius: 1rem; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }

        /* Hero Section */
        .hero-card { background: white; padding: 2rem; border-radius: 1.5rem; box-shadow: 0 4px 6px rgba(0,0,0,0.05); margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: center; }
        .btn-primary { background: var(--primary); color: white; padding: 0.75rem 1.5rem; border-radius: 0.75rem; text-decoration: none; font-weight: 600; display: inline-block; margin-top: 1rem; transition: 0.2s; }

        /* Stats Grid */
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1.5rem; margin-bottom: 3rem; }
        .stat-card { background: white; padding: 1.5rem; border-radius: 1rem; display: flex; flex-direction: column; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
        .stat-value { font-size: 2.5rem; font-weight: 700; }

        /* Quotes Style */
        .quote-card { background: white; padding: 1.5rem; border-radius: 1rem; box-shadow: 0 2px 4px rgba(0,0,0,0.05); margin-bottom: 1rem; border-left: 4px solid var(--secondary); position: relative; }
        .quote-text { font-size: 1.1rem; font-style: italic; color: var(--gray-800); margin-bottom: 1rem; }
    </style>
</head>
<body>

    <aside class="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo">📚</div>
            <span>PinjamBuku</span>
        </div>
        <ul class="sidebar-menu">
            <li><a href="{{ route('dashboard') }}" class="active">🏠<span>Dashboard</span></a></li>
            <li><a href="{{ route('books.collection') }}">📖<span>Koleksi Buku</span></a></li>
            <li><a href="{{ route('loans') }}">📤<span>Peminjaman</span></a></li>
            <li><a href="/favorit">❤️<span>Favorit</span></a></li>
            <li><a href="{{ route('history') }}">📋<span>Riwayat</span></a></li>
            <li><a href="{{ route('settings') }}">⚙️<span>Pengaturan</span></a></li>
        </ul>
    </aside>

    <div class="main-content">
        
        <div class="top-bar">
            <h2>Dashboard</h2>
            <a href="{{ route('profile.edit') }}" style="text-decoration: none; color: inherit;">
                <div class="user-profile">
                    <span>Halo, <strong>{{ $user->name }}</strong></span>
                    <div class="avatar">
                        @if($user->avatar)
                            <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar">
                        @else
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        @endif
                    </div>
                </div>
            </a>
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
                <div class="stat-value" style="color: var(--warning);">{{ $stats['active_loans'] ?? 0 }}</div>
                <div class="stat-label">Sedang Dipinjam</div>
            </div>
            <div class="stat-card">
                <div class="stat-value" style="color: var(--danger);">{{ $stats['favorites'] ?? 0 }}</div>
                <div class="stat-label">Buku Favorit</div>
            </div>
            <div class="stat-card">
                <div class="stat-value" style="color: var(--success);">{{ $stats['total_returned'] ?? 0 }}</div>
                <div class="stat-label">Buku Dikembalikan</div>
            </div>
        </div>

        <div class="card" style="margin-bottom: 2rem;">
            <h2 style="font-size: 1.25rem; font-weight: 700; margin-bottom: 1.5rem;">📊 Statistik Membaca Anda</h2>
            <div style="position: relative; height: 300px;">
                <canvas id="readingChart"></canvas>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
            <div class="card">
                <h3 style="margin-bottom: 1rem;">✨ Bagikan Kutipan</h3>
                @if(isset($activeLoans) && $activeLoans->count() > 0)
                <form action="{{ route('quotes.store') }}" method="POST">
                    @csrf
                    <select name="book_id" style="width: 100%; padding: 0.8rem; border-radius: 0.5rem; margin-bottom: 1rem; border: 1px solid #ddd;" required>
                        @foreach($activeLoans as $loan)
                            <option value="{{ $loan->book->id }}">{{ $loan->book->title }}</option>
                        @endforeach
                    </select>
                    <textarea name="text" style="width: 100%; padding: 0.8rem; border-radius: 0.5rem; margin-bottom: 1rem; border: 1px solid #ddd;" rows="3" placeholder="Kutipan menarik..."></textarea>
                    <button type="submit" class="btn-primary" style="width: 100%; border: none; cursor: pointer;">Kirim</button>
                </form>
                @else
                <p style="color: #6b7280; font-style: italic;">Pinjam buku dulu untuk berbagi kutipan!</p>
                @endif
            </div>

            <div>
                <h3 style="margin-bottom: 1rem;">💬 Feed Kutipan</h3>
                @if(isset($quotes) && $quotes->count() > 0)
                    @foreach($quotes as $quote)
                    <div class="quote-card">
                        <p class="quote-text">"{{ $quote->text }}"</p>
                        <small><strong>{{ $quote->user->name }}</strong> - {{ $quote->book->title }}</small>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const ctx = document.getElementById('readingChart').getContext('2d');
            const monthlyData = <?php echo json_encode($monthlyLoans ?? [0,0,0,0,0,0,0,0,0,0,0,0]); ?>;
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                    datasets: [{
                        label: 'Buku Dipinjam',
                        data: monthlyData,
                        backgroundColor: '#3b82f6',
                        borderRadius: 5
                    }]
                },
                options: { responsive: true, maintainAspectRatio: false }
            });
        });
    </script>
</body>
</html>