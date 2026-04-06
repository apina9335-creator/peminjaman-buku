<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BookNook - Sudut Baca Digitalmu</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700,800&display=swap" rel="stylesheet" />
    <style>
        :root {
            --primary: #3b82f6; 
            --primary-dark: #1e40af;
            --bg-body: #f8fafc;
            --bg-card: #ffffff;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --shadow: rgba(0,0,0,0.05);
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Instrument Sans', sans-serif; background: var(--bg-body); color: var(--text-main); line-height: 1.6; display: flex; flex-direction: column; min-height: 100vh; overflow-x: hidden; }
        
        nav { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(12px); position: fixed; width: 100%; top: 0; z-index: 50; border-bottom: 1px solid #e2e8f0; }
        .nav-container { max-width: 1200px; margin: 0 auto; padding: 1.2rem 2rem; display: flex; justify-content: space-between; align-items: center; }
        
        .logo { display: flex; align-items: center; gap: 0.8rem; font-size: 1.5rem; font-weight: 800; color: var(--primary-dark); text-decoration: none; letter-spacing: -0.5px; }
        .logo svg { width: 2rem; height: 2rem; color: var(--primary); }
        
        .nav-links { display: flex; gap: 1rem; align-items: center; }
        .btn { padding: 0.6rem 1.5rem; border-radius: 2rem; font-weight: 600; text-decoration: none; transition: 0.3s; }
        .btn-login { color: var(--primary-dark); background: #e0f2fe; }
        .btn-login:hover { background: #bae6fd; }
        .btn-register { background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); color: white; box-shadow: 0 4px 10px rgba(59, 130, 246, 0.3); }
        .btn-register:hover { transform: translateY(-2px); box-shadow: 0 6px 15px rgba(59, 130, 246, 0.4); }

        .hero { padding: 10rem 2rem 5rem; max-width: 1200px; margin: 0 auto; display: flex; flex-direction: column; align-items: center; text-align: center; }
        .hero h1 { font-size: 4.5rem; font-weight: 800; line-height: 1.1; margin-bottom: 1.5rem; color: var(--text-main); letter-spacing: -1px; }
        .hero h1 span { background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .hero p { font-size: 1.2rem; color: var(--text-muted); max-width: 600px; margin-bottom: 2.5rem; }
        
        .hero-btn { padding: 1.2rem 3rem; font-size: 1.1rem; border-radius: 3rem; background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); color: white; font-weight: 700; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; transition: 0.3s; box-shadow: 0 10px 25px rgba(59, 130, 246, 0.4); }
        .hero-btn:hover { transform: translateY(-3px); box-shadow: 0 15px 35px rgba(59, 130, 246, 0.5); }

        .features { max-width: 1200px; margin: 0 auto 5rem; padding: 0 2rem; display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2.5rem; }
        .feature-card { background: var(--bg-card); padding: 3rem 2rem; border-radius: 1.5rem; box-shadow: 0 10px 30px var(--shadow); border: 1px solid #f1f5f9; text-align: center; transition: 0.3s; }
        .feature-card:hover { transform: translateY(-10px); border-color: var(--primary); box-shadow: 0 20px 40px rgba(59, 130, 246, 0.1); }
        .feature-icon { font-size: 3rem; margin-bottom: 1.5rem; display: inline-flex; align-items: center; justify-content: center; background: #eff6ff; width: 80px; height: 80px; border-radius: 50%; box-shadow: 0 4px 10px rgba(59, 130, 246, 0.1); }
        .feature-card h3 { font-size: 1.4rem; font-weight: 800; margin-bottom: 1rem; color: var(--text-main); }
        .feature-card p { color: var(--text-muted); line-height: 1.6; font-size: 1.05rem; }
        
        footer { text-align: center; padding: 2rem; color: var(--text-muted); border-top: 1px solid #e2e8f0; margin-top: auto; font-weight: 500; }
        
        /* Animasi Mengambang */
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0px); }
        }
        .floating-icon { animation: float 4s ease-in-out infinite; display: inline-block; font-size: 4rem; margin-bottom: 1rem; }

        @media (max-width: 768px) {
            .hero h1 { font-size: 3rem; }
            .hero { padding: 8rem 1rem 3rem; }
        }
    </style>
</head>
<body>

    <nav>
        <div class="nav-container">
            <a href="/" class="logo">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                </svg>
                BookNook
            </a>
            <div class="nav-links">
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-register">Ke Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-login">Masuk</a>
                    <a href="{{ route('register') }}" class="btn btn-register">Daftar</a>
                @endauth
            </div>
        </div>
    </nav>

    <section class="hero">
        <div class="floating-icon">✨📖</div>
        <h1>Perpustakaan Digital<br><span>di Genggamanmu</span></h1>
        <p>Temukan ribuan buku menarik, kelola peminjaman dengan mudah, dan nikmati pengalaman membaca tanpa batas bersama BookNook.</p>
        
        @auth
            <a href="{{ url('/dashboard') }}" class="hero-btn">Lanjut Membaca 🚀</a>
        @else
            <a href="{{ route('register') }}" class="hero-btn">Mulai Sekarang 🚀</a>
        @endauth
    </section>

    <section class="features">
        <div class="feature-card">
            <div class="feature-icon">⚡</div>
            <h3>Akses Cepat</h3>
            <p>Cari dan pinjam buku fisik maupun digital hanya dalam hitungan detik melalui sistem kami yang super responsif.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">📚</div>
            <h3>Koleksi Lengkap</h3>
            <p>Lebih dari 1,000+ koleksi buku dari berbagai genre: Novel, Sains, Teknologi, Bisnis, dan Sejarah.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">❤️</div>
            <h3>Fitur Komunitas</h3>
            <p>Simpan buku ke favorit, bagikan kutipan favoritmu, dan berdiskusi dengan sesama pembaca lewat ulasan.</p>
        </div>
    </section>

    <footer>
        <p>&copy; {{ date('Y') }} BookNook. Dibuat dengan ❤️ untuk para pembaca.</p>
    </footer>

</body>
</html>