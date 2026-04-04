<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'PinjamBuku')</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700&display=swap" rel="stylesheet" />
    <style>
        /* === 1. GLOBAL VARIABLES (THEME) === */
        :root {
            --bg-body: #f0f9ff;
            --bg-card: #ffffff;
            --bg-sidebar: linear-gradient(180deg, #3b82f6 0%, #8b5cf6 100%);
            --text-main: #1f2937;
            --text-muted: #6b7280;
            --border-color: #e5e7eb;
            --shadow: rgba(0,0,0,0.05);
            --input-bg: #ffffff;
            
            --primary: #3b82f6; 
            --warning: #f59e0b; 
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
            
            --gray-100: #334155;
            --gray-200: #334155;
            --gray-300: #475569;
        }

        /* === 2. RESET & LAYOUT === */
        * { margin: 0; padding: 0; box-sizing: border-box; transition: background-color 0.3s, color 0.3s, border-color 0.3s; }
        body { font-family: 'Instrument Sans', sans-serif; background: var(--bg-body); color: var(--text-main); display: flex; min-height: 100vh; }
        a { text-decoration: none; color: inherit; }

        /* === 3. SIDEBAR (Global) === */
        .sidebar { width: 280px; background: var(--bg-sidebar); color: white; padding: 2rem 1.5rem; position: fixed; height: 100vh; overflow-y: auto; z-index: 100; }
        .sidebar-header { display: flex; align-items: center; gap: 1rem; margin-bottom: 3rem; font-size: 1.5rem; font-weight: 700; }
        .sidebar-logo { width: 2.8rem; height: 2.8rem; background: rgba(255,255,255,0.25); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; }
        .sidebar-menu { list-style: none; }
        .sidebar-menu li { margin-bottom: 0.75rem; }
        .sidebar-menu a { display: flex; align-items: center; gap: 1rem; color: rgba(255,255,255,0.85); padding: 0.85rem 1rem; border-radius: 0.75rem; transition: 0.3s; font-weight: 500; }
        .sidebar-menu a:hover, .sidebar-menu a.active { background: rgba(255,255,255,0.2); color: white; transform: translateX(4px); }
        .sidebar-menu-icon { width: 1.5rem; text-align: center; }

        /* === 4. MAIN CONTENT WRAPPER === */
        .main-content { flex: 1; margin-left: 280px; display: flex; flex-direction: column; min-height: 100vh; }
        
        /* Navbar */
        nav { background: var(--bg-card); box-shadow: 0 4px 12px var(--shadow); position: sticky; top: 0; z-index: 50; border-bottom: 1px solid var(--border-color); }
        nav .container { max-width: 1400px; margin: 0 auto; padding: 1.2rem 2rem; display: flex; justify-content: space-between; align-items: center; }
        .user-menu { display: flex; align-items: center; gap: 2rem; }
        .user-info { display: flex; align-items: center; gap: 1rem; }
        .user-avatar { width: 3.2rem; height: 3.2rem; border-radius: 50%; background: var(--primary); color: white; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 1.3rem; }
        .user-details h4 { font-size: 1rem; margin-bottom: 0.25rem; font-weight: 700; }
        .user-details p { font-size: 0.8rem; color: var(--text-muted); }

        .theme-toggle { background: var(--bg-card); border: 1px solid var(--border-color); color: var(--text-main); padding: 0.5rem; border-radius: 50%; cursor: pointer; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; box-shadow: 0 2px 5px var(--shadow); }
        .theme-toggle:hover { transform: scale(1.1); }
        .logout-btn { padding: 0.6rem 1.2rem; background: var(--danger); color: white; border: none; border-radius: 0.6rem; cursor: pointer; font-weight: 600; font-size: 0.85rem; }

        /* Page Container */
        .page-container { max-width: 1400px; margin: 0 auto; padding: 2.5rem; flex: 1; width: 100%; }

        /* === 5. UTILITY CLASSES (Bisa dipakai di semua halaman) === */
        .page-header { margin-bottom: 2.5rem; }
        .page-header h1 { font-size: 2.5rem; margin-bottom: 0.5rem; font-weight: 700; }
        .page-header p { color: var(--text-muted); font-size: 1rem; }
        
        .card { background: var(--bg-card); padding: 1.5rem; border-radius: 1rem; box-shadow: 0 2px 4px var(--shadow); border: 1px solid var(--border-color); margin-bottom: 2rem; }
        
        /* NOTIFIKASI */
        .alert { padding: 1rem; border-radius: 0.5rem; margin-bottom: 1.5rem; border: 1px solid transparent; }
        .alert-success { background: rgba(16, 185, 129, 0.1); color: var(--success); border-color: var(--success); }
        .alert-danger { background: rgba(239, 68, 68, 0.1); color: var(--danger); border-color: var(--danger); }

        /* Inject Page Specific CSS */
        @yield('styles')
    </style>
</head>
<body>

    <aside class="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo">📚</div>
            <span>PinjamBuku</span>
        </div>
        <ul class="sidebar-menu">
            
            {{-- ========================================== --}}
            {{-- FITUR KHUSUS ADMIN --}}
            {{-- ========================================== --}}
            @if(Auth::user()->is_admin)
            <li style="margin-bottom: 0.5rem;">
                <a href="{{ route('admin.dashboard') }}" style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); color: white; font-weight: 700; box-shadow: 0 4px 10px rgba(220, 38, 38, 0.4); border: 1px solid #b91c1c;">
                    <span class="sidebar-menu-icon">🛡️</span>
                    <span>Panel Admin</span>
                </a>
            </li>
            
            {{-- MENU BARU: MONITORING PINJAMAN (Ditambahkan di sini) --}}
            <li style="margin-bottom: 1.5rem;">
                <a href="{{ route('admin.loans.active') }}" class="{{ request()->routeIs('admin.loans.active') ? 'active' : '' }}">
                    <span class="sidebar-menu-icon">🔭</span>
                    <span>Monitoring Pinjaman</span>
                </a>
            </li>
            @endif

            {{-- MENU UTAMA USER --}}
            <li><a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"><span class="sidebar-menu-icon">🏠</span><span>Dashboard</span></a></li>
            <li><a href="{{ route('books.collection') }}" class="{{ request()->routeIs('books.collection') ? 'active' : '' }}"><span class="sidebar-menu-icon">📖</span><span>Koleksi Buku</span></a></li>
            <li><a href="{{ route('loans') }}" class="{{ request()->routeIs('loans') ? 'active' : '' }}"><span class="sidebar-menu-icon">📤</span><span>Peminjaman</span></a></li>
            <li><a href="{{ route('favorites') }}" class="{{ request()->routeIs('favorites') ? 'active' : '' }}"><span class="sidebar-menu-icon">❤️</span><span>Favorit</span></a></li>
            <li><a href="{{ route('history') }}" class="{{ request()->routeIs('history') ? 'active' : '' }}"><span class="sidebar-menu-icon">📋</span><span>Riwayat</span></a></li>
            <li><a href="{{ route('settings') }}" class="{{ request()->routeIs('settings') ? 'active' : '' }}"><span class="sidebar-menu-icon">⚙️</span><span>Pengaturan</span></a></li>
        </ul>
    </aside>

    <div class="main-content">
        <nav>
            <div class="container">
                <div style="font-weight: 700;">🔔 Notifikasi</div>
                <div class="user-menu">
                    <button class="theme-toggle" onclick="toggleTheme()" id="themeBtn" title="Ganti Mode">🌙</button>

                   <a href="{{ route('profile.edit') }}" class="user-info" style="cursor: pointer; transition: opacity 0.2s;" onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'">
    
    @if(Auth::user()->avatar)
        <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Profile" style="width: 3.2rem; height: 3.2rem; border-radius: 50%; object-fit: cover;">
    @else
        <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
    @endif
    
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

        <div class="page-container">
            @yield('content')
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

        function updateIcon(theme) {
            themeBtn.innerText = theme === 'dark' ? '☀️' : '🌙';
        }
    </script>
    
    @yield('scripts')
</body>
</html>