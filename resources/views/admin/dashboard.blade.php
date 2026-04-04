<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - PinjamBuku</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700&display=swap" rel="stylesheet" />
    <style>
        /* === RESET & VARIABLES === */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --primary: #2563eb; --primary-dark: #1e40af;
            --secondary: #8b5cf6; --secondary-light: #ddd6fe;
            --success: #10b981; --warning: #f59e0b; --danger: #ef4444;
            --gray-100: #f3f4f6; --gray-200: #e5e7eb; --gray-600: #4b5563; --gray-800: #1f2937;
            --white: #ffffff;
            
            /* Warna Background Baru yang lebih elegan */
            --bg-admin: linear-gradient(135deg, #e0e7ff 0%, #f3f4f6 100%); 
        }
        
        /* MENGUBAH BACKGROUND BODY DI SINI */
        body { 
            font-family: 'Instrument Sans', sans-serif; 
            background: var(--bg-admin); 
            color: var(--gray-800); 
            min-height: 100vh;
        }
        
        a { text-decoration: none; color: inherit; }

        /* === NAVBAR === */
        .navbar { 
            background: var(--white); 
            padding: 1.2rem 2rem; 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); 
            margin-bottom: 2.5rem; 
            position: sticky;
            top: 0;
            z-index: 50;
        }
        .brand { font-size: 1.25rem; font-weight: 700; color: var(--primary); display: flex; align-items: center; gap: 0.5rem; }
        .nav-links { display: flex; align-items: center; gap: 1.5rem; }
        .nav-link { font-weight: 500; color: var(--gray-600); font-size: 0.95rem; transition: 0.2s; }
        .nav-link:hover { color: var(--primary); }
        .btn-logout { background: none; border: none; color: var(--danger); font-weight: 700; cursor: pointer; font-size: 0.95rem; }
        .btn-logout:hover { text-decoration: underline; }

        /* === CONTAINER === */
        .container { max-width: 1200px; margin: 0 auto; padding: 0 1.5rem 3rem; }

        /* === HERO === */
        .hero { 
            background: var(--white); 
            padding: 2.5rem; 
            border-radius: 1rem; 
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1); 
            margin-bottom: 2rem; 
            border: 1px solid rgba(255,255,255,0.5);
        }
        .hero h1 { font-size: 1.8rem; margin-bottom: 0.5rem; color: var(--gray-800); }
        .hero p { color: var(--gray-600); font-size: 1.1rem; }

        /* === GRID SYSTEM === */
        .dashboard-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem; margin-bottom: 2rem; }
        
        /* === CARDS === */
        .card { 
            background: var(--white); 
            border-radius: 1rem; 
            padding: 1.5rem; 
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); 
            transition: all 0.3s ease; 
            position: relative; 
            border: 1px solid rgba(255,255,255,0.8); 
            display: flex; 
            flex-direction: column; 
            justify-content: space-between; 
            height: 100%; 
        }
        .card:hover { 
            transform: translateY(-5px); 
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04); 
        }
        
        .card-blue { border-left: 6px solid var(--primary); }
        .card-yellow { border-left: 6px solid var(--warning); }
        .card-purple { border-left: 6px solid var(--secondary); }
        .card-green { border-left: 6px solid var(--success); }
        
        .card-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1rem; }
        .card-title { font-size: 1.1rem; font-weight: 700; margin-bottom: 0.25rem; }
        .card-desc { font-size: 0.85rem; color: var(--gray-600); }
        .card-icon { font-size: 2rem; opacity: 0.2; }
        
        .card-stat { font-size: 2.5rem; font-weight: 800; margin-top: auto; }
        .card-stat.blue { color: var(--primary); }
        .card-stat.green { color: var(--success); }
        .card-stat.purple { color: var(--secondary); }

        /* Badge Notification */
        .badge { display: inline-block; padding: 0.3rem 0.8rem; border-radius: 2rem; font-size: 0.8rem; font-weight: 700; color: white; }
        .badge-red { background: var(--danger); animation: pulse 2s infinite; }
        .badge-green { background: var(--success); }
        @keyframes pulse { 0% { transform: scale(1); box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.7); } 70% { transform: scale(1.05); box-shadow: 0 0 0 10px rgba(239, 68, 68, 0); } 100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(239, 68, 68, 0); } }

        /* === TABLE === */
        .table-wrapper { background: var(--white); border-radius: 1rem; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1); overflow: hidden; border: 1px solid rgba(255,255,255,0.8); }
        .table-header { padding: 1.5rem; border-bottom: 1px solid var(--gray-200); display: flex; justify-content: space-between; align-items: center; background: #ffffff; }
        .table-title { font-weight: 700; font-size: 1.2rem; color: var(--gray-800); }
        
        table { width: 100%; border-collapse: collapse; }
        th { text-align: left; padding: 1.2rem 1.5rem; background: #f8fafc; font-size: 0.85rem; color: var(--gray-600); text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 2px solid var(--gray-200); }
        td { padding: 1rem 1.5rem; border-bottom: 1px solid var(--gray-100); font-size: 0.95rem; vertical-align: middle; }
        tr:last-child td { border-bottom: none; }
        tr:hover { background: #f1f5f9; }

        .book-cover { width: 45px; height: 60px; object-fit: cover; border-radius: 6px; background: #eee; display: flex; align-items: center; justify-content: center; font-size: 0.8rem; color: #999; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .category-badge { background: #e0f2fe; padding: 0.3rem 0.8rem; border-radius: 6px; font-size: 0.8rem; color: #0284c7; font-weight: 600; }
        
        .btn-delete { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; padding: 0.5rem 1rem; border-radius: 0.5rem; cursor: pointer; font-size: 0.85rem; font-weight: 600; transition: 0.2s; }
        .btn-delete:hover { background: #fca5a5; color: #7f1d1d; }

        @media (max-width: 768px) {
            .navbar { flex-direction: column; gap: 1rem; }
            .dashboard-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="brand">🛡️ Admin Panel</div>
        <div class="nav-links">
            <a href="{{ route('admin.loans.index') }}" class="nav-link">Validasi Pinjam</a>
            <span style="color: #ddd;">|</span>
            <a href="{{ route('dashboard') }}" class="nav-link">User Dashboard</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-logout">Logout</button>
            </form>
        </div>
    </nav>

    <div class="container">
        
        @if(session('success'))
            <div style="background: #d1fae5; color: #065f46; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1.5rem; border: 1px solid #a7f3d0; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                ✅ {{ session('success') }}
            </div>
        @endif

        <div class="hero">
            <h1>Selamat Datang, Admin! 👮‍♂️</h1>
            <p>Kelola koleksi buku, validasi peminjaman, dan moderasi ulasan pengguna di sini.</p>
        </div>

        <div class="dashboard-grid">
            
            <a href="{{ route('admin.books.create') }}" class="card card-blue">
                <div class="card-header">
                    <div>
                        <div class="card-title" style="color: var(--primary);">➕ Tambah Buku</div>
                        <div class="card-desc">Input koleksi baru</div>
                    </div>
                    <div class="card-icon">📚</div>
                </div>
            </a>

            <a href="{{ route('admin.loans.index') }}" class="card card-yellow">
                <div class="card-header">
                    <div>
                        <div class="card-title" style="color: #b45309;">📩 Validasi Pinjam</div>
                        <div class="card-desc">Cek pengajuan masuk</div>
                    </div>
                    @if(isset($pendingLoansCount) && $pendingLoansCount > 0)
                        <span class="badge badge-red">{{ $pendingLoansCount }}</span>
                    @else
                        <span class="badge badge-green">0</span>
                    @endif
                </div>
            </a>

            <a href="{{ route('admin.reviews.index') }}" class="card card-purple">
                <div class="card-header">
                    <div>
                        <div class="card-title" style="color: var(--secondary);">⭐ Kelola Ulasan</div>
                        <div class="card-desc">Moderasi rating user</div>
                    </div>
                    <span class="badge" style="background: var(--secondary); color: white;">
                        {{ $reviewsCount ?? 0 }}
                    </span>
                </div>
            </a>

            <a href="{{ route('admin.users.index') }}" class="card card-green">
                <div class="card-header">
                    <div>
                        <div class="card-title" style="color: var(--success);">👥 Kelola User</div>
                        <div class="card-desc">Cek akun terdaftar</div>
                    </div>
                    <div class="card-icon">👤</div>
                </div>
                <div class="card-stat green">{{ $userCount ?? 0 }}</div>
            </a>

            <div class="card">
                <div class="card-header">
                    <div class="card-desc" style="font-weight: 700; color: var(--gray-800);">TOTAL JUDUL BUKU</div>
                </div>
                <div class="card-stat green">{{ $bookCount ?? 0 }}</div>
            </div>

            <a href="{{ route('admin.loans.active') }}" class="card" style="cursor: pointer;">
                <div class="card-header">
                    <div class="card-desc" style="font-weight: 700; color: var(--gray-800);">SEDANG DIPINJAM</div>
                    <div style="font-size: 1.5rem;">🔭</div>
                </div>
                <div class="card-stat purple">
                    {{ $activeLoansCount ?? 0 }}
                </div>
            </a>

        </div>

        <div class="table-wrapper">
            <div class="table-header">
                <div class="table-title">📚 Manajemen Koleksi Buku</div>
                <div style="font-size: 0.9rem; font-weight: 600; color: var(--primary); background: #e0e7ff; padding: 0.3rem 0.8rem; border-radius: 2rem;">Total: {{ $bookCount ?? 0 }} judul</div>
            </div>
            <div style="overflow-x: auto;">
                <table>
                    <thead>
                        <tr>
                            <th>Cover</th>
                            <th>Info Buku</th>
                            <th>Kategori</th>
                            <th>Stok</th>
                            <th style="text-align: right;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse(\App\Models\Book::orderBy('created_at', 'desc')->take(10)->get() as $book)
                        <tr>
                            <td>
                                @if($book->cover_image)
                                    <img src="{{ asset('storage/' . $book->cover_image) }}" class="book-cover">
                                @else
                                    <div class="book-cover" style="font-weight:bold; font-size: 1.2rem;">{{ substr($book->title, 0, 1) }}</div>
                                @endif
                            </td>
                            <td>
                                <div style="font-weight: 700; color: var(--gray-800); font-size: 1.05rem;">{{ $book->title }}</div>
                                <div style="font-size: 0.85rem; color: var(--gray-600); margin-top: 0.2rem;">👤 {{ $book->author }}</div>
                            </td>
                            <td>
                                <span class="category-badge">{{ $book->category ?? 'Umum' }}</span>
                            </td>
                            <td style="font-weight: 700; color: var(--primary); font-size: 1.1rem;">
                                {{ $book->stock }}
                            </td>
                            <td style="text-align: right;">
                                <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete">🗑️ Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 4rem; color: var(--gray-600);">
                                <div style="font-size: 3rem; margin-bottom: 1rem;">📭</div>
                                <div style="font-weight: 600; font-size: 1.1rem;">Belum ada buku</div>
                                <p style="font-size: 0.9rem; margin-top: 0.5rem;">Silakan tambahkan buku baru melalui menu di atas.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</body>
</html>