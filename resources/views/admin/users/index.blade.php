<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pengguna - Admin PinjamBuku</title>
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700&display=swap" rel="stylesheet" />
    <style>
        /* === RESET & STYLE SAMA SEPERTI DASHBOARD === */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root { --primary: #2563eb; --gray-100: #f3f4f6; --gray-800: #1f2937; --white: #ffffff; --danger: #ef4444; }
        body { font-family: 'Instrument Sans', sans-serif; background-color: var(--gray-100); color: var(--gray-800); display: flex; }
        
        /* Sidebar */
        .sidebar { width: 280px; background: linear-gradient(180deg, #1e40af 0%, #6d28d9 100%); color: white; padding: 2rem 1.5rem; position: fixed; height: 100vh; overflow-y: auto; }
        .sidebar-menu { list-style: none; margin-top: 2rem; }
        .sidebar-menu li { margin-bottom: 0.75rem; }
        .sidebar-menu a { display: flex; align-items: center; gap: 1rem; color: rgba(255,255,255,0.85); text-decoration: none; padding: 0.85rem 1rem; border-radius: 0.75rem; transition: 0.3s; }
        .sidebar-menu a:hover, .sidebar-menu a.active { background: rgba(255,255,255,0.2); color: white; transform: translateX(4px); }
        .sidebar-icon { width: 1.5rem; text-align: center; }

        /* Content */
        .main-content { flex: 1; margin-left: 280px; padding: 2.5rem; }
        h1 { font-size: 1.8rem; margin-bottom: 0.5rem; }
        p { color: #6b7280; margin-bottom: 2rem; }

        /* Table */
        .table-wrapper { background: var(--white); border-radius: 1rem; box-shadow: 0 2px 5px rgba(0,0,0,0.05); overflow: hidden; }
        table { width: 100%; border-collapse: collapse; }
        th { text-align: left; padding: 1rem 1.5rem; background: #f9fafb; font-size: 0.85rem; color: #6b7280; text-transform: uppercase; border-bottom: 1px solid #e5e7eb; }
        td { padding: 1rem 1.5rem; border-bottom: 1px solid #f3f4f6; font-size: 0.95rem; vertical-align: middle; }
        
        /* Badges */
        .badge-admin { background: #dbeafe; color: #1e40af; padding: 0.2rem 0.6rem; border-radius: 4px; font-size: 0.75rem; font-weight: 700; }
        .badge-user { background: #f3f4f6; color: #374151; padding: 0.2rem 0.6rem; border-radius: 4px; font-size: 0.75rem; font-weight: 600; }
        
        /* Button */
        .btn-delete { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; padding: 0.4rem 0.8rem; border-radius: 0.4rem; cursor: pointer; font-size: 0.8rem; font-weight: 600; }
        .btn-delete:hover { background: #fecaca; }
        .btn-back { display: inline-block; text-decoration: none; color: #4b5563; margin-bottom: 1rem; font-weight: 600; }
    </style>
</head>
<body>

    <aside class="sidebar">
        <div style="font-size: 1.5rem; font-weight: 700;">🛡️ Admin Panel</div>
        <ul class="sidebar-menu">
            <li><a href="{{ route('admin.dashboard') }}"><span class="sidebar-icon">🏠</span> Dashboard</a></li>
            <li><a href="{{ route('admin.users.index') }}" class="active"><span class="sidebar-icon">👥</span> Kelola Pengguna</a></li>
            <li><a href="{{ route('admin.books.create') }}"><span class="sidebar-icon">📚</span> Kelola Buku</a></li>
            <li><a href="{{ route('admin.loans.index') }}"><span class="sidebar-icon">📩</span> Peminjaman</a></li>
            <li><a href="{{ route('admin.reviews.index') }}"><span class="sidebar-icon">⭐</span> Ulasan</a></li>
        </ul>
    </aside>

    <div class="main-content">
        <a href="{{ route('admin.dashboard') }}" class="btn-back">← Kembali ke Dashboard</a>
        <h1>Daftar Pengguna Terdaftar</h1>
        <p>Pantau siapa saja yang memiliki akses ke perpustakaan.</p>

        @if(session('success'))
            <div style="background: #d1fae5; color: #065f46; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1.5rem;">
                ✅ {{ session('success') }}
            </div>
        @endif

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Nama Pengguna</th>
                        <th>Email</th>
                        <th>Peran</th>
                        <th>Tanggal Daftar</th>
                        <th style="text-align: right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td>
                            <div style="font-weight: 700;">{{ $user->name }}</div>
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if($user->is_admin)
                                <span class="badge-admin">ADMIN</span>
                            @else
                                <span class="badge-user">USER</span>
                            @endif
                        </td>
                        <td style="color: #6b7280; font-size: 0.9rem;">
                            {{ $user->created_at->format('d M Y') }}
                        </td>
                        <td style="text-align: right;">
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Hapus pengguna ini secara permanen?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete">Hapus Akun</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 3rem; color: #999;">Tidak ada pengguna lain.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div style="margin-top: 1rem;">
            {{ $users->links() }}
        </div>
    </div>

</body>
</html>