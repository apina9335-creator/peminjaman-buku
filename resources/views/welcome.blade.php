<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PinjamBuku - Perpustakaan Digital</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700&display=swap" rel="stylesheet" />
    <style>
        /* === STYLE LANDING PAGE === */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --primary: #3b82f6; --primary-dark: #1e40af; 
            --secondary: #8b5cf6; --gray-800: #1f2937;
        }
        body { font-family: 'Instrument Sans', sans-serif; background: #f0f9ff; color: var(--gray-800); }

        /* Navbar Transparan */
        nav { display: flex; justify-content: space-between; align-items: center; padding: 1.5rem 2rem; max-width: 1200px; margin: 0 auto; }
        .logo { font-size: 1.5rem; font-weight: 700; display: flex; align-items: center; gap: 0.5rem; color: var(--primary-dark); }
        .nav-links { display: flex; gap: 1.5rem; align-items: center; }
        .nav-links a { text-decoration: none; color: var(--gray-800); font-weight: 600; transition: 0.3s; }
        .nav-links a:hover { color: var(--primary); }
        
        .btn-login { padding: 0.6rem 1.5rem; border: 2px solid var(--primary); border-radius: 2rem; color: var(--primary); font-weight: 700; text-decoration: none; transition: 0.3s; }
        .btn-login:hover { background: var(--primary); color: white; }
        
        .btn-dashboard { padding: 0.6rem 1.5rem; background: var(--primary); border-radius: 2rem; color: white; font-weight: 700; text-decoration: none; box-shadow: 0 4px 10px rgba(59, 130, 246, 0.3); }

        /* Hero Section */
        .hero { display: flex; align-items: center; justify-content: space-between; max-width: 1200px; margin: 3rem auto; padding: 0 2rem; gap: 2rem; min-height: 70vh; }
        .hero-content { flex: 1; }
        .hero h1 { font-size: 3.5rem; line-height: 1.2; margin-bottom: 1.5rem; background: linear-gradient(135deg, var(--primary-dark) 0%, var(--secondary) 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .hero p { font-size: 1.1rem; color: #4b5563; margin-bottom: 2.5rem; line-height: 1.6; max-width: 500px; }
        
        .hero-image { flex: 1; display: flex; justify-content: center; }
        .hero-image div { font-size: 15rem; animation: float 3s ease-in-out infinite; }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }

        /* Features */
        .features { background: white; padding: 4rem 2rem; }
        .features-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem; max-width: 1200px; margin: 0 auto; }
        .feature-card { padding: 2rem; border-radius: 1rem; background: #f9fafb; border: 1px solid #e5e7eb; transition: 0.3s; }
        .feature-card:hover { transform: translateY(-5px); border-color: var(--primary); }
        .feature-icon { font-size: 2.5rem; margin-bottom: 1rem; }
        .feature-title { font-size: 1.25rem; font-weight: 700; margin-bottom: 0.5rem; }
        .feature-desc { color: #6b7280; font-size: 0.95rem; }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .hero { flex-direction: column-reverse; text-align: center; margin-top: 1rem; }
            .hero h1 { font-size: 2.5rem; }
            .hero p { margin: 0 auto 2rem; }
        }
    </style>
</head>
<body>

    <nav>
        <div class="logo">📚 PinjamBuku</div>
        <div class="nav-links">
            @if (Route::has('login'))
                @auth
                    {{-- Jika user SUDAH login, tampilkan tombol ke Dashboard --}}
                    <a href="{{ url('/dashboard') }}" class="btn-dashboard">Buka Dashboard 🚀</a>
                @else
                    {{-- Jika user BELUM login, tampilkan Login & Register --}}
                    <a href="{{ route('login') }}" class="btn-login">Masuk</a>
                    <a href="{{ route('register') }}" style="font-weight: 700; color: var(--gray-800);">Daftar</a>
                @endauth
            @endif
        </div>
    </nav>

    <header class="hero">
        <div class="hero-content">
            <h1>Perpustakaan Digital <br> di Genggamanmu</h1>
            <p>Temukan ribuan buku menarik, kelola peminjaman dengan mudah, dan nikmati pengalaman membaca tanpa batas bersama PinjamBuku.</p>
            
            @auth
                <a href="{{ route('books.collection') }}" class="btn-dashboard" style="padding: 1rem 2rem; font-size: 1.1rem;">Jelajahi Koleksi 📖</a>
            @else
                <a href="{{ route('register') }}" class="btn-dashboard" style="padding: 1rem 2rem; font-size: 1.1rem;">Mulai Sekarang ✨</a>
            @endauth
        </div>
        <div class="hero-image">
            <div>📖</div>
        </div>
    </header>

    <section class="features">
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">🚀</div>
                <h3 class="feature-title">Akses Cepat</h3>
                <p class="feature-desc">Cari dan pinjam buku fisik hanya dalam hitungan detik melalui sistem digital kami.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">📚</div>
                <h3 class="feature-title">Koleksi Lengkap</h3>
                <p class="feature-desc">Lebih dari 1,000+ koleksi buku dari berbagai genre: Novel, Sains, Teknologi, dan Sejarah.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">❤️</div>
                <h3 class="feature-title">Fitur Favorit</h3>
                <p class="feature-desc">Simpan buku yang ingin Anda baca nanti ke dalam daftar favorit pribadi Anda.</p>
            </div>
        </div>
    </section>

</body>
</html>