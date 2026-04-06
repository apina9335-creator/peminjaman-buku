<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - BookNook</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700&display=swap" rel="stylesheet" />
    <style>
        /* === KONFIGURASI WARNA (Mendukung Dark Mode) === */
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

        /* === STYLE DASAR === */
        * { margin: 0; padding: 0; box-sizing: border-box; transition: background-color 0.3s, color 0.3s, border-color 0.3s; }
        body { font-family: 'Instrument Sans', sans-serif; background: var(--bg-body); color: var(--text-main); line-height: 1.6; display: flex; overflow-x: hidden; }

        /* SIDEBAR */
        .sidebar { width: 280px; background: var(--bg-sidebar); color: white; padding: 2rem 1.5rem; position: fixed; height: 100vh; overflow-y: auto; z-index: 100; box-shadow: 4px 0 15px rgba(0,0,0,0.15); }
        .sidebar-header { display: flex; align-items: center; gap: 1rem; margin-bottom: 3rem; font-size: 1.6rem; font-weight: 800; letter-spacing: -0.5px; }
        .sidebar-logo { width: 2.8rem; height: 2.8rem; background: rgba(255,255,255,0.25); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; color: white; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        .sidebar-menu { list-style: none; }
        .sidebar-menu li { margin-bottom: 0.75rem; }
        .sidebar-menu a { display: flex; align-items: center; gap: 1rem; color: rgba(255,255,255,0.85); text-decoration: none; padding: 0.85rem 1rem; border-radius: 0.75rem; font-weight: 500; transition: 0.3s; }
        .sidebar-menu a:hover, .sidebar-menu a.active { background: rgba(255,255,255,0.2); color: white; transform: translateX(4px); }
        .sidebar-menu-icon { font-size: 1.3rem; width: 1.5rem; text-align: center; }

        /* MAIN CONTENT & NAVBAR */
        .main-content { flex: 1; margin-left: 280px; min-height: 100vh; display: flex; flex-direction: column; max-width: calc(100vw - 280px); }
        
        nav { background: var(--bg-card); box-shadow: 0 4px 12px var(--shadow); position: sticky; top: 0; z-index: 50; border-bottom: 1px solid var(--border-color); width: 100%; }
        .nav-container { padding: 1rem 2.5rem; display: flex; justify-content: space-between; align-items: center; gap: 1rem; }
        
        .nav-left h2 { font-size: 1.5rem; color: var(--text-main); font-weight: 800; margin: 0; }

        /* PROFIL ANTI GEPENG */
        .user-menu { display: flex; align-items: center; gap: 1rem; flex-shrink: 0; }
        .user-info { display: flex; align-items: center; gap: 0.8rem; text-decoration: none; background: var(--bg-card); padding: 0.4rem 1.2rem 0.4rem 0.4rem; border-radius: 3rem; border: 1px solid var(--border-color); transition: 0.2s; box-shadow: 0 2px 8px var(--shadow); max-width: 260px; }
        .user-info:hover { background: var(--gray-100); transform: translateY(-2px); }
        
        .user-avatar-container { flex: 0 0 40px; width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); color: white; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 1.1rem; overflow: hidden; }
        .user-avatar-container img { width: 100%; height: 100%; object-fit: cover; display: block; }
        
        .user-details { display: flex; flex-direction: column; justify-content: center; min-width: 0; flex: 1; }
        .user-details h4 { font-size: 0.95rem; color: var(--text-main); margin: 0; font-weight: 700; line-height: 1.2; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .user-details p { font-size: 0.75rem; color: var(--text-muted); margin: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }

        .theme-toggle { background: var(--bg-card); border: 1px solid var(--border-color); color: var(--text-main); padding: 0.5rem; border-radius: 50%; cursor: pointer; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; box-shadow: 0 2px 8px var(--shadow); transition: 0.2s; flex-shrink: 0; }
        .theme-toggle:hover { background: var(--gray-100); }
        
        .logout-btn { padding: 0.6rem 1.2rem; background: linear-gradient(135deg, var(--danger) 0%, #dc2626 100%); color: white; border: none; border-radius: 2rem; cursor: pointer; font-weight: 600; font-size: 0.9rem; white-space: nowrap; box-shadow: 0 2px 8px rgba(239, 68, 68, 0.3); transition: 0.2s; flex-shrink: 0; }
        .logout-btn:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4); }

        /* === KONTEN DASHBOARD === */
        .dashboard-container { padding: 2.5rem; flex: 1; width: 100%; }

        .hero-card { background: var(--bg-card); padding: 2rem 2.5rem; border-radius: 1.5rem; box-shadow: 0 4px 20px var(--shadow); margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: center; border: 1px solid var(--border-color); }
        .hero-text h1 { color: var(--text-main); font-weight: 800; font-size: 2.2rem; margin-bottom: 0.5rem; line-height: 1.2; }
        .hero-text p { color: var(--text-muted); font-size: 1.05rem; }
        .btn-primary { background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); color: white; padding: 0.8rem 1.5rem; border-radius: 0.75rem; text-decoration: none; font-weight: 700; display: inline-block; margin-top: 1rem; transition: 0.2s; border: none; font-size: 0.95rem; cursor: pointer; }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4); }

        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1.5rem; margin-bottom: 3rem; }
        .stat-card { background: var(--bg-card); padding: 1.5rem; border-radius: 1.2rem; display: flex; flex-direction: column; box-shadow: 0 4px 15px var(--shadow); border: 1px solid var(--border-color); text-align: center; }
        .stat-value { font-size: 2.8rem; font-weight: 800; line-height: 1; margin-bottom: 0.5rem; }
        .stat-label { color: var(--text-muted); font-size: 0.9rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; }

        .card { background: var(--bg-card); padding: 2rem; border-radius: 1.5rem; box-shadow: 0 4px 15px var(--shadow); border: 1px solid var(--border-color); margin-bottom: 2rem; }
        .card h3, .card h2 { color: var(--text-main); font-weight: 800; margin-bottom: 1.5rem; }

        .quote-card { background: var(--gray-100); padding: 1.5rem; border-radius: 1rem; margin-bottom: 1rem; border-left: 4px solid var(--primary); }
        .quote-text { font-size: 1.05rem; font-style: italic; color: var(--text-main); margin-bottom: 0.8rem; }
        .quote-author { color: var(--text-muted); font-size: 0.85rem; font-weight: 600; }

        .form-select, .form-textarea { width: 100%; padding: 0.85rem 1.25rem; border-radius: 0.75rem; margin-bottom: 1rem; border: 2px solid var(--border-color); background: var(--input-bg); color: var(--text-main); font-family: inherit; font-size: 0.95rem; transition: 0.3s; }
        .form-select:focus, .form-textarea:focus { border-color: var(--primary); outline: none; }
    </style>
</head>
<body>

    <aside class="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width: 1.6rem; height: 1.6rem;">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                </svg>
            </div>
            <span>BookNook</span>
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
        
        <nav>
            <div class="nav-container">
                <div class="nav-left">
                    <h2>Dashboard</h2>
                </div>
                
                <div class="user-menu">
                    <button class="theme-toggle" onclick="toggleTheme()" id="themeBtn" title="Ganti Mode">🌙</button>

                    <a href="{{ route('profile.edit') }}" class="user-info">
                        <div class="user-avatar-container">
                            @if(Auth::user()->avatar)
                                <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Profile">
                            @else
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            @endif
                        </div>
                        <div class="user-details">
                            <h4>{{ Auth::user()->name }}</h4>
                            <p>{{ Auth::user()->email }}</p>
                        </div>
                    </a>

                    <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                        @csrf <button type="submit" class="logout-btn">Logout</button>
                    </form>
                </div>
            </div>
        </nav>

        <div class="dashboard-container">
            @if(session('success'))
                <div style="background: rgba(16, 185, 129, 0.1); color: var(--success); padding: 1rem; border-radius: 0.5rem; margin-bottom: 1.5rem; border: 1px solid var(--success);">
                    ✅ <strong>Berhasil!</strong> {{ session('success') }}
                </div>
            @endif

            <div class="hero-card">
                <div class="hero-text">
                    <h1>Selamat Datang di BookNook! ✨</h1>
                    <p>Sudut baca digitalmu. Akses ribuan literatur dengan mudah dari mana saja.</p>
                    <a href="{{ route('books.collection') }}" class="btn-primary">Jelajahi Koleksi 📖</a>
                </div>
                <div style="font-size: 5rem; text-shadow: 0 10px 20px var(--shadow);">📖✨</div>
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

            <div class="card">
                <h2>📊 Statistik Membaca Anda</h2>
                <div style="position: relative; height: 300px; width: 100%;">
                    <canvas id="readingChart"></canvas>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 2rem;">
                <div class="card" style="margin-bottom: 0;">
                    <h3>✨ Bagikan Kutipan</h3>
                    @if(isset($activeLoans) && $activeLoans->count() > 0)
                    <form action="{{ route('quotes.store') }}" method="POST">
                        @csrf
                        <select name="book_id" class="form-select" required>
                            @foreach($activeLoans as $loan)
                                <option value="{{ $loan->book->id }}">{{ $loan->book->title }}</option>
                            @endforeach
                        </select>
                        <textarea name="text" class="form-textarea" rows="4" placeholder="Tulis kutipan keren dari buku ini..."></textarea>
                        <button type="submit" class="btn-primary" style="width: 100%; margin-top: 0;">Kirim Kutipan</button>
                    </form>
                    @else
                    <p style="color: var(--text-muted); font-style: italic;">Pinjam buku dulu untuk berbagi kutipan ke komunitas!</p>
                    @endif
                </div>

                <div class="card" style="margin-bottom: 0;">
                    <h3>💬 Feed Kutipan Komunitas</h3>
                    <div style="max-height: 350px; overflow-y: auto; padding-right: 0.5rem;">
                        @if(isset($quotes) && $quotes->count() > 0)
                            @foreach($quotes as $quote)
                            <div class="quote-card">
                                <p class="quote-text">"{{ $quote->text }}"</p>
                                <div class="quote-author">
                                    <strong style="color: var(--primary);">{{ $quote->user->name }}</strong> • {{ $quote->book->title }}
                                </div>
                            </div>
                            @endforeach
                        @else
                            <p style="color: var(--text-muted); font-style: italic;">Belum ada kutipan. Jadilah yang pertama membagikan!</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
            
            if (window.readingChartInstance) {
                Chart.defaults.color = newTheme === 'dark' ? '#94a3b8' : '#6b7280';
                window.readingChartInstance.update();
            }
        }
        function updateIcon(theme) { if(themeBtn) themeBtn.innerText = theme === 'dark' ? '☀️' : '🌙'; }

        document.addEventListener("DOMContentLoaded", function() {
            const ctx = document.getElementById('readingChart').getContext('2d');
            Chart.defaults.color = savedTheme === 'dark' ? '#94a3b8' : '#6b7280';
            Chart.defaults.font.family = "'Instrument Sans', sans-serif";
            
            const monthlyData = <?php echo json_encode($monthlyLoans ?? [0,0,0,0,0,0,0,0,0,0,0,0]); ?>;
            
            window.readingChartInstance = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                    datasets: [{
                        label: 'Buku Dipinjam',
                        data: monthlyData,
                        backgroundColor: '#3b82f6',
                        borderRadius: 6,
                        hoverBackgroundColor: '#1e40af'
                    }]
                },
                options: { 
                    responsive: true, 
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: { beginAtZero: true, ticks: { precision: 0 } },
                        x: { grid: { display: false } }
                    }
                }
            });
        });
    </script>
</body>
</html>