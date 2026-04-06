<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Peminjaman - BookNook</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700&display=swap" rel="stylesheet" />
    <style>
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
        body { font-family: 'Instrument Sans', sans-serif; background: var(--bg-body); color: var(--text-main); line-height: 1.6; display: flex; overflow-x: hidden; }

        .sidebar { width: 280px; background: var(--bg-sidebar); color: white; padding: 2rem 1.5rem; position: fixed; height: 100vh; overflow-y: auto; z-index: 100; box-shadow: 4px 0 15px rgba(0,0,0,0.15); }
        .sidebar-header { display: flex; align-items: center; gap: 1rem; margin-bottom: 3rem; font-size: 1.6rem; font-weight: 800; letter-spacing: -0.5px; }
        .sidebar-logo { width: 2.8rem; height: 2.8rem; background: rgba(255,255,255,0.25); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; color: white; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        .sidebar-menu { list-style: none; }
        .sidebar-menu li { margin-bottom: 0.75rem; }
        .sidebar-menu a { display: flex; align-items: center; gap: 1rem; color: rgba(255,255,255,0.85); text-decoration: none; padding: 0.85rem 1rem; border-radius: 0.75rem; font-weight: 500; transition: 0.3s; }
        .sidebar-menu a:hover, .sidebar-menu a.active { background: rgba(255,255,255,0.2); color: white; transform: translateX(4px); }
        .sidebar-menu-icon { font-size: 1.3rem; width: 1.5rem; text-align: center; }

        .main-content { flex: 1; margin-left: 280px; min-height: 100vh; display: flex; flex-direction: column; max-width: calc(100vw - 280px); }
        nav { background: var(--bg-card); box-shadow: 0 4px 12px var(--shadow); position: sticky; top: 0; z-index: 50; border-bottom: 1px solid var(--border-color); width: 100%; }
        .nav-container { padding: 1rem 2.5rem; display: flex; justify-content: space-between; align-items: center; gap: 1rem; }
        .nav-left h2 { font-size: 1.5rem; color: var(--text-main); font-weight: 800; margin: 0; }

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

        .container { max-width: 1400px; margin: 0 auto; padding: 2.5rem; flex: 1; width: 100%; }
        .page-header { margin-bottom: 2rem; }
        .page-header h1 { font-size: 2.2rem; color: var(--text-main); margin-bottom: 0.3rem; font-weight: 800; line-height: 1.2; }
        .page-header p { color: var(--text-muted); font-size: 1rem; }

        .loans-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.5rem; }
        .loan-card { background: var(--bg-card); border-radius: 1.2rem; overflow: hidden; box-shadow: 0 4px 15px var(--shadow); border: 1px solid var(--border-color); display: flex; padding: 1.5rem; gap: 1.5rem; align-items: center; }
        .book-cover { width: 80px; height: 120px; flex-shrink: 0; border-radius: 0.5rem; background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; overflow: hidden; }
        .book-cover img { width: 100%; height: 100%; object-fit: cover; }
        .loan-info { flex: 1; min-width: 0; }
        .loan-info h3 { font-size: 1.1rem; color: var(--text-main); margin-bottom: 0.3rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; font-weight: 700; }
        .loan-info p { font-size: 0.85rem; color: var(--text-muted); margin-bottom: 0.8rem; }
        
        .status-badge { display: inline-block; padding: 0.3rem 0.8rem; border-radius: 2rem; font-size: 0.75rem; font-weight: 700; }
        .status-pending { background: rgba(245, 158, 11, 0.1); color: var(--warning); border: 1px solid rgba(245, 158, 11, 0.3); }
        .status-borrowed { background: rgba(16, 185, 129, 0.1); color: var(--success); border: 1px solid rgba(16, 185, 129, 0.3); }
        .status-overdue { background: rgba(239, 68, 68, 0.1); color: var(--danger); border: 1px solid rgba(239, 68, 68, 0.3); }

        .return-btn { margin-top: 1rem; width: 100%; padding: 0.6rem; border-radius: 0.5rem; background: var(--gray-100); border: 1px solid var(--border-color); color: var(--text-main); font-weight: 600; cursor: pointer; transition: 0.2s; font-family: inherit; }
        .return-btn:hover { background: var(--gray-200); }
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
            <li><a href="{{ route('dashboard') }}"><span class="sidebar-menu-icon">🏠</span><span>Dashboard</span></a></li>
            <li><a href="{{ route('books.collection') }}"><span class="sidebar-menu-icon">📖</span><span>Koleksi Buku</span></a></li>
            <li><a href="{{ route('loans') }}" class="active"><span class="sidebar-menu-icon">📤</span><span>Peminjaman</span></a></li>
            <li><a href="/favorit"><span class="sidebar-menu-icon">❤️</span><span>Favorit</span></a></li>
            <li><a href="{{ route('history') }}"><span class="sidebar-menu-icon">📋</span><span>Riwayat</span></a></li>
            <li><a href="{{ route('settings') }}"><span class="sidebar-menu-icon">⚙️</span><span>Pengaturan</span></a></li>
        </ul>
    </aside>

    <div class="main-content">
        <nav>
            <div class="nav-container">
                <div class="nav-left"><h2>Peminjaman Anda</h2></div>
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

        <div class="container">
            @if(session('success'))
                <div style="background: rgba(16, 185, 129, 0.1); color: var(--success); padding: 1rem; border-radius: 0.5rem; margin-bottom: 1.5rem; border: 1px solid var(--success);">
                    ✅ <strong>Berhasil!</strong> {{ session('success') }}
                </div>
            @endif

            <div class="page-header">
                <h1>Buku Sedang Dipinjam 📤</h1>
                <p>Pantau status peminjaman dan tanggal jatuh tempo buku Anda.</p>
            </div>

            @if($activeLoans->count() > 0)
                <div class="loans-grid">
                    @foreach($activeLoans as $loan)
                    <div class="loan-card">
                        <div class="book-cover">
                            @if($loan->book->cover_image)
                                <img src="{{ asset('storage/' . $loan->book->cover_image) }}">
                            @else
                                {{ strtoupper(substr($loan->book->title, 0, 1)) }}
                            @endif
                        </div>
                        <div class="loan-info">
                            <h3>{{ $loan->book->title }}</h3>
                            <p>{{ $loan->book->author }}</p>
                            
                            @if($loan->status == 'pending')
                                <span class="status-badge status-pending">🕒 Menunggu Persetujuan Admin</span>
                                <p style="font-size: 0.75rem; margin-top: 0.5rem; color: var(--text-muted);">Diajukan: {{ \Carbon\Carbon::parse($loan->loan_date)->format('d M Y') }}</p>
                            @elseif($loan->status == 'borrowed')
                                <span class="status-badge status-borrowed">✅ Sedang Dipinjam</span>
                                <p style="font-size: 0.75rem; margin-top: 0.5rem; color: var(--text-muted);">Tenggat: <strong style="color: var(--danger);">{{ \Carbon\Carbon::parse($loan->return_date)->format('d M Y') }}</strong></p>
                                <form action="{{ route('loans.return', $loan->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="return-btn">Kembalikan Buku</button>
                                </form>
                            @elseif($loan->status == 'overdue')
                                <span class="status-badge status-overdue">⚠️ Terlambat Dikembalikan!</span>
                                <p style="font-size: 0.75rem; margin-top: 0.5rem; color: var(--text-muted);">Tenggat: <strong style="color: var(--danger);">{{ \Carbon\Carbon::parse($loan->return_date)->format('d M Y') }}</strong></p>
                                <form action="{{ route('loans.return', $loan->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="return-btn" style="background: rgba(239, 68, 68, 0.1); color: var(--danger); border-color: var(--danger);">Kembalikan Segera</button>
                                </form>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div style="background: var(--bg-card); border: 1px solid var(--border-color); border-radius: 1rem; padding: 3rem; text-align: center; box-shadow: 0 4px 6px var(--shadow);">
                    <div style="font-size: 3rem; margin-bottom: 1rem;">📭</div>
                    <h3 style="color: var(--text-main); margin-bottom: 0.5rem;">Tidak ada buku yang sedang dipinjam</h3>
                    <p style="color: var(--text-muted); margin-bottom: 1.5rem;">Yuk, jelajahi koleksi kami dan mulai membaca!</p>
                    <a href="{{ route('books.collection') }}" style="background: var(--primary); color: white; padding: 0.75rem 1.5rem; border-radius: 0.5rem; text-decoration: none; font-weight: 600;">Lihat Koleksi Buku</a>
                </div>
            @endif
        </div>
    </div>

    <script>
        const html = document.documentElement;
        const themeBtn = document.getElementById('themeBtn');
        const savedTheme = localStorage.getItem('theme') || 'light';
        html.setAttribute('data-theme', savedTheme);
        if(themeBtn) themeBtn.innerText = savedTheme === 'dark' ? '☀️' : '🌙';

        function toggleTheme() {
            const currentTheme = html.getAttribute('data-theme');
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';
            html.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            if(themeBtn) themeBtn.innerText = newTheme === 'dark' ? '☀️' : '🌙';
        }
    </script>
</body>
</html>