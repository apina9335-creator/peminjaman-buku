<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kelola Ulasan - Admin PinjamBuku</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700&display=swap" rel="stylesheet" />
    <style>
        /* === STYLE DASAR === */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Instrument Sans', sans-serif; background: #f0f9ff; display: flex; color: #1f2937; }

        /* Sidebar Admin (Warna Sedikit Lebih Gelap untuk membedakan dengan User) */
        .sidebar { width: 280px; background: linear-gradient(180deg, #1e40af 0%, #6d28d9 100%); color: white; padding: 2rem 1.5rem; position: fixed; height: 100vh; overflow-y: auto; }
        .sidebar-header { display: flex; align-items: center; gap: 1rem; margin-bottom: 3rem; font-size: 1.5rem; font-weight: 700; }
        .sidebar-menu { list-style: none; }
        .sidebar-menu li { margin-bottom: 0.75rem; }
        .sidebar-menu a { display: flex; align-items: center; gap: 1rem; color: rgba(255,255,255,0.85); text-decoration: none; padding: 0.85rem 1rem; border-radius: 0.75rem; transition: 0.3s; font-weight: 500; }
        .sidebar-menu a:hover, .sidebar-menu a.active { background: rgba(255,255,255,0.2); color: white; transform: translateX(4px); }
        .sidebar-menu-icon { width: 1.5rem; text-align: center; }

        /* Main Content */
        .main-content { flex: 1; margin-left: 280px; padding: 2.5rem; min-height: 100vh; }
        .page-header h1 { font-size: 2rem; margin-bottom: 0.5rem; color: #111827; font-weight: 700; }
        .page-header p { color: #6b7280; margin-bottom: 2rem; }

        /* Table Style */
        .table-container { background: white; border-radius: 1rem; box-shadow: 0 4px 6px rgba(0,0,0,0.05); overflow: hidden; }
        table { width: 100%; border-collapse: collapse; }
        th { background: #f9fafb; text-align: left; padding: 1rem 1.5rem; font-weight: 600; color: #4b5563; font-size: 0.9rem; border-bottom: 1px solid #e5e7eb; }
        td { padding: 1rem 1.5rem; border-bottom: 1px solid #f3f4f6; color: #1f2937; vertical-align: top; }
        tr:last-child td { border-bottom: none; }
        
        .user-cell { font-weight: 600; color: #111827; }
        .book-cell { color: #2563eb; font-weight: 500; }
        .rating-stars { color: #f59e0b; letter-spacing: 2px; }
        .comment-text { color: #4b5563; font-size: 0.95rem; line-height: 1.5; font-style: italic; }
        .date-cell { color: #9ca3af; font-size: 0.85rem; }

        /* Delete Button */
        .btn-delete { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; padding: 0.5rem 1rem; border-radius: 0.5rem; cursor: pointer; font-weight: 600; font-size: 0.85rem; transition: 0.2s; }
        .btn-delete:hover { background: #fecaca; }

        /* Pagination */
        .pagination { margin-top: 2rem; display: flex; justify-content: center; }
        
        /* Logout Button */
        .logout-btn { margin-top: auto; display: block; width: 100%; padding: 0.75rem; background: rgba(255,255,255,0.1); border: none; color: white; text-align: left; border-radius: 0.75rem; cursor: pointer; }
    </style>
</head>
<body>

    <aside class="sidebar">
        <div class="sidebar-header">
            <div style="font-size: 2rem;">🛡️</div>
            <span>Admin Panel</span>
        </div>
        <ul class="sidebar-menu">
            <li><a href="{{ route('admin.dashboard') }}"><span class="sidebar-menu-icon">🏠</span><span>Dashboard</span></a></li>
            <li><a href="{{ route('admin.books.create') }}"><span class="sidebar-menu-icon">📚</span><span>Kelola Buku</span></a></li>
            <li><a href="{{ route('admin.loans.index') }}"><span class="sidebar-menu-icon">DM</span><span>Peminjaman</span></a></li>
            {{-- MENU BARU --}}
            <li><a href="{{ route('admin.reviews.index') }}" class="active"><span class="sidebar-menu-icon">⭐</span><span>Kelola Ulasan</span></a></li>
        </ul>

        <div style="margin-top: 3rem;">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">🚪 Logout</button>
            </form>
        </div>
    </aside>

    <div class="main-content">
        <div class="page-header">
            <h1>Manajemen Ulasan & Rating ⭐</h1>
            <p>Pantau semua ulasan masuk dan hapus ulasan yang mengandung spam atau kata kasar.</p>
        </div>

        @if(session('success'))
            <div style="background: #d1fae5; color: #065f46; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1.5rem;">
                ✅ {{ session('success') }}
            </div>
        @endif

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th width="15%">Pengguna</th>
                        <th width="20%">Buku</th>
                        <th width="15%">Rating</th>
                        <th width="35%">Komentar</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reviews as $review)
                    <tr>
                        <td>
                            <div class="user-cell">{{ $review->user->name }}</div>
                            <div class="date-cell">{{ $review->created_at->format('d M Y, H:i') }}</div>
                        </td>
                        <td>
                            <div class="book-cell">{{ $review->book->title }}</div>
                        </td>
                        <td>
                            <div class="rating-stars">
                                @for($i=1; $i<=5; $i++)
                                    {{ $i <= $review->rating ? '★' : '☆' }}
                                @endfor
                            </div>
                            <span style="font-size: 0.8rem; color: #666;">({{ $review->rating }}/5)</span>
                        </td>
                        <td>
                            <div class="comment-text">"{{ $review->comment ?? 'Tidak ada komentar tertulis.' }}"</div>
                        </td>
                        <td>
                            <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus ulasan ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete">🗑️ Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach

                    @if($reviews->isEmpty())
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 3rem; color: #9ca3af;">
                                Belum ada ulasan yang masuk.
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <div class="pagination">
            {{ $reviews->links() }}
        </div>
    </div>

</body>
</html>