<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profil {{ $targetUser->name }} - PinjamBuku</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700&display=swap" rel="stylesheet" />
    <style>
        /* Menggunakan style dasar yang sama agar seragam */
        :root { --bg-body: linear-gradient(135deg, #f0f9ff 0%, #f5f3ff 100%); --bg-card: #ffffff; --bg-sidebar: linear-gradient(180deg, #3b82f6 0%, #8b5cf6 100%); --text-main: #1f2937; --text-muted: #6b7280; --border-color: #e5e7eb; --shadow: rgba(0,0,0,0.06); --primary: #3b82f6; --primary-light: #dbeafe; --primary-dark: #1e40af; --danger: #ef4444; --success: #10b981; --warning: #f59e0b; --gray-100: #f3f4f6; }
        [data-theme="dark"] { --bg-body: #0f172a; --bg-card: #1e293b; --bg-sidebar: linear-gradient(180deg, #1e3a8a 0%, #5b21b6 100%); --text-main: #f1f5f9; --text-muted: #94a3b8; --border-color: #334155; --shadow: rgba(0,0,0,0.3); --gray-100: #334155; }
        * { margin: 0; padding: 0; box-sizing: border-box; transition: 0.3s; }
        body { font-family: 'Instrument Sans', sans-serif; background: var(--bg-body); color: var(--text-main); display: flex; min-height: 100vh; }
        .sidebar { width: 280px; background: var(--bg-sidebar); color: white; padding: 2rem 1.5rem; position: fixed; height: 100vh; z-index: 100; box-shadow: 4px 0 15px rgba(0,0,0,0.15); }
        .main-content { flex: 1; margin-left: 280px; display: flex; flex-direction: column; }
        nav { background: var(--bg-card); padding: 1.2rem 2.5rem; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 4px 12px var(--shadow); border-bottom: 1px solid var(--border-color); }
        .back-btn { text-decoration: none; color: var(--text-main); font-weight: 600; padding: 0.5rem 1.2rem; background: var(--bg-card); border-radius: 2rem; border: 1px solid var(--border-color); box-shadow: 0 2px 10px var(--shadow); display: inline-flex; align-items: center; gap: 0.5rem; }
        .back-btn:hover { background: var(--gray-100); transform: translateX(-3px); }
        .card { background: var(--bg-card); padding: 3rem; border-radius: 1.5rem; box-shadow: 0 4px 20px var(--shadow); border: 1px solid var(--border-color); text-align: center; width: 100%; max-width: 500px; }
        .avatar-lg { width: 160px; height: 160px; margin: 0 auto 1.5rem auto; border-radius: 50%; overflow: hidden; border: 6px solid var(--primary-light); box-shadow: 0 10px 25px var(--shadow); background: linear-gradient(135deg, var(--primary), var(--primary-dark)); color: white; display: flex; align-items: center; justify-content: center; font-size: 5rem; font-weight: bold; }
        .avatar-lg img { width: 100%; height: 100%; object-fit: cover; }
    </style>
</head>
<body>
    <aside class="sidebar">
        <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 3rem; font-size: 1.5rem; font-weight: 700;">
            <div style="width: 2.8rem; height: 2.8rem; background: rgba(255,255,255,0.25); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center;">📚</div>
            <span>PinjamBuku</span>
        </div>
        <ul style="list-style: none;">
            <li style="margin-bottom: 0.75rem;"><a href="{{ route('dashboard') }}" style="display: flex; align-items: center; gap: 1rem; color: rgba(255,255,255,0.85); text-decoration: none; padding: 0.85rem 1rem; border-radius: 0.75rem; font-weight: 500;">🏠 Dashboard</a></li>
            <li style="margin-bottom: 0.75rem;"><a href="{{ route('books.collection') }}" style="display: flex; align-items: center; gap: 1rem; color: rgba(255,255,255,0.85); text-decoration: none; padding: 0.85rem 1rem; border-radius: 0.75rem; font-weight: 500;">📖 Koleksi Buku</a></li>
        </ul>
    </aside>

    <div class="main-content">
        <nav>
            <a href="javascript:history.back()" class="back-btn">⬅️ Kembali</a>
            <h3 style="margin: 0;">Profil Anggota</h3>
        </nav>

        <div style="flex: 1; display: flex; align-items: center; justify-content: center; padding: 2rem;">
            <div class="card">
                <div class="avatar-lg">
                    @if($targetUser->avatar)
                        <img src="{{ asset('storage/' . $targetUser->avatar) }}" alt="Avatar">
                    @else
                        {{ strtoupper(substr($targetUser->name, 0, 1)) }}
                    @endif
                </div>
                <h1 style="font-size: 2.2rem; margin-bottom: 0.5rem; color: var(--text-main);">{{ $targetUser->name }}</h1>
                <p style="font-size: 1.1rem; color: var(--text-muted); margin-bottom: 2rem;">Anggota sejak {{ $targetUser->created_at->format('M Y') }}</p>

                <div style="display: flex; justify-content: center; gap: 3rem; background: var(--gray-100); padding: 1.5rem; border-radius: 1.2rem; border: 1px solid var(--border-color);">
                    <div>
                        <h2 style="color: var(--primary); font-size: 2.2rem; margin-bottom: 0.2rem;">{{ $totalLoans }}</h2>
                        <p style="color: var(--text-muted); font-weight: 600; font-size: 0.9rem; text-transform: uppercase;">Buku Dipinjam</p>
                    </div>
                    <div>
                        <h2 style="color: var(--warning); font-size: 2.2rem; margin-bottom: 0.2rem;">{{ $totalReviews }}</h2>
                        <p style="color: var(--text-muted); font-weight: 600; font-size: 0.9rem; text-transform: uppercase;">Ulasan Ditulis</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script> document.documentElement.setAttribute('data-theme', localStorage.getItem('theme') || 'light'); </script>
</body>
</html>