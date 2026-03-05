<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>PinjamBuku - Sistem Peminjaman Buku Online</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700&display=swap" rel="stylesheet" />

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Instrument Sans', 'Segoe UI', sans-serif;
            color: #1f2937;
            background: #f9fafb;
        }

        /* Navbar */
        .navbar {
            background: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.2rem 3rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar h1 {
            font-size: 1.8rem;
            background: linear-gradient(135deg, #52240a, #b39a11);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 700;
        }

        .nav-btn {
            display: flex;
            gap: 1rem;
        }

        .nav-btn a {
            text-decoration: none;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .nav-btn .login {
            color: #3b82f6;
            border: 2px solid #3b82f6;
            background: transparent;
        }

        .nav-btn .login:hover {
            background: #3b82f6;
            color: white;
            transform: translateY(-2px);
        }

        .nav-btn .register {
            background: linear-gradient(135deg, #3b82f6, #f3c035);
            color: white;
            border: none;
        }

        .nav-btn .register:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(59, 130, 246, 0.3);
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, #3b82f6 0%, #f6f866 100%);
            padding: 6rem 3rem;
            text-align: center;
            color: white;
            min-height: 70vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hero-content {
            max-width: 900px;
        }

        .hero h2 {
            font-size: 3.5rem;
            margin-bottom: 1rem;
            font-weight: 700;
            letter-spacing: -0.02em;
        }

        .hero p {
            font-size: 1.25rem;
            margin-bottom: 2rem;
            opacity: 0.95;
            line-height: 1.6;
        }

        .hero-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-bottom: 3rem;
        }

        .hero-buttons a {
            text-decoration: none;
            padding: 1rem 2rem;
            border-radius: 0.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            font-size: 1rem;
        }

        .btn-primary {
            background: white;
            color: #3b82f6;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.15);
        }

        .btn-secondary {
            background: transparent;
            color: white;
            border: 2px solid white;
        }

        .btn-secondary:hover {
            background: white;
            color: #3b82f6;
        }

        /* Stats */
        .hero-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
            margin-top: 4rem;
        }

        .stat-item {
            background: rgba(255,255,255,0.15);
            padding: 1.5rem;
            border-radius: 0.75rem;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.2);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            font-size: 0.95rem;
            opacity: 0.9;
        }

        /* Features Section */
        .features-section {
            padding: 6rem 3rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        .section-title {
            text-align: center;
            margin-bottom: 4rem;
        }

        .section-title h2 {
            font-size: 2.5rem;
            color: #1f2937;
            margin-bottom: 1rem;
            font-weight: 700;
        }

        .section-title p {
            font-size: 1.1rem;
            color: #6b7280;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
        }

        .feature-card {
            background: white;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            border: 1px solid #e5e7eb;
        }

        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 16px 32px rgba(0,0,0,0.12);
            border-color: #3b82f6;
        }

        .feature-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            display: inline-block;
        }

        .feature-card h3 {
            font-size: 1.3rem;
            margin-bottom: 0.75rem;
            color: #1f2937;
            font-weight: 700;
        }

        .feature-card p {
            color: #6b7280;
            line-height: 1.6;
            font-size: 0.95rem;
        }

        /* Books Section */
        .books-section {
            padding: 6rem 3rem;
            background: white;
        }

        .books-container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .books-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1.5rem;
        }

        .book-item {
            background: linear-gradient(135deg, #3b82f6, #e6d929);
            border-radius: 0.75rem;
            overflow: hidden;
            cursor: pointer;
            transition: all 0.3s ease;
            height: 280px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            font-weight: 700;
            position: relative;
        }

        .book-item:hover {
            transform: translateY(-8px);
            box-shadow: 0 16px 32px rgba(59, 130, 246, 0.3);
        }

        .book-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(180deg, transparent, rgba(0,0,0,0.3));
            padding: 1rem;
            color: white;
            font-size: 0.9rem;
            font-weight: 600;
        }

        /* Benefits Section */
        .benefits-section {
            padding: 6rem 3rem;
            background: linear-gradient(135deg, #f0f9ff, #f5f3ff);
        }

        .benefits-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .benefits-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .benefit-item {
            background: white;
            padding: 2rem;
            border-radius: 0.75rem;
            border-left: 4px solid #3b82f6;
        }

        .benefit-item:nth-child(2) {
            border-left-color: #f0ca20;
        }

        .benefit-item:nth-child(3) {
            border-left-color: #06b6d4;
        }

        .benefit-item:nth-child(4) {
            border-left-color: #10b981;
        }

        .benefit-item h3 {
            font-size: 1.2rem;
            margin-bottom: 0.75rem;
            color: #1f2937;
            font-weight: 700;
        }

        .benefit-item p {
            color: #6b7280;
            line-height: 1.6;
            font-size: 0.95rem;
        }

        /* Testimonials */
        .testimonials-section {
            padding: 6rem 3rem;
            background: white;
        }

        .testimonials-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .testimonials-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .testimonial-card {
            background: #f9fafb;
            padding: 2rem;
            border-radius: 0.75rem;
            border: 1px solid #e5e7eb;
        }

        .testimonial-stars {
            color: #fbbf24;
            font-size: 1.2rem;
            margin-bottom: 1rem;
        }

        .testimonial-text {
            color: #4b5563;
            line-height: 1.7;
            margin-bottom: 1.5rem;
            font-style: italic;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .author-avatar {
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 50%;
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1rem;
        }

        .author-info h4 {
            font-size: 0.95rem;
            color: #1f2937;
            margin-bottom: 0.2rem;
            font-weight: 700;
        }

        .author-info p {
            font-size: 0.85rem;
            color: #6b7280;
        }

        /* CTA Section */
        .cta-section {
            padding: 6rem 3rem;
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
            color: white;
            text-align: center;
        }

        .cta-content {
            max-width: 800px;
            margin: 0 auto;
        }

        .cta-section h2 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            font-weight: 700;
        }

        .cta-section p {
            font-size: 1.1rem;
            margin-bottom: 2rem;
            opacity: 0.95;
        }

        .cta-button {
            display: inline-block;
            background: white;
            color: #3b82f6;
            padding: 1rem 2.5rem;
            border-radius: 0.5rem;
            text-decoration: none;
            font-weight: 700;
            transition: all 0.3s ease;
        }

        .cta-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.2);
        }

        /* Footer */
        footer {
            background: #1f2937;
            color: white;
            text-align: center;
            padding: 2rem;
            font-size: 0.9rem;
        }

        /* Responsive */
        @media(max-width: 768px) {
            .navbar {
                padding: 1rem;
                flex-direction: column;
                gap: 1rem;
            }

            .hero h2 {
                font-size: 2.2rem;
            }

            .hero p {
                font-size: 1rem;
            }

            .hero-stats {
                grid-template-columns: 1fr;
            }

            .hero-buttons {
                flex-direction: column;
                align-items: center;
            }

            .section-title h2 {
                font-size: 1.8rem;
            }

            .features-grid {
                grid-template-columns: 1fr;
            }

            .cta-section h2 {
                font-size: 1.8rem;
            }

            .hero-buttons a {
                display: block;
            }
        }
</head>
<body>

<!-- Navbar -->
<div class="navbar">
    <h1>📚 PinjamBuku</h1>
    <div class="nav-btn">
        <a href="{{ route('login') }}" class="login">Login</a>
        <a href="{{ route('register') }}" class="register">Daftar Sekarang</a>
    </div>
</div>

<!-- Hero Section -->
<div class="hero">
    <div class="hero-content">
        <h2>Perpustakaan Digital di Genggaman Anda</h2>
        <p>Akses koleksi buku terlengkap dengan sistem peminjaman online yang mudah, cepat, dan modern</p>
        
        <div class="hero-buttons">
            <a href="{{ route('register') }}" class="btn-primary">Mulai Sekarang</a>
            <a href="#features" class="btn-secondary">Pelajari Lebih Lanjut</a>
        </div>

        <div class="hero-stats">
            <div class="stat-item">
                <div class="stat-number">10K+</div>
                <div class="stat-label">Koleksi Buku</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">5K+</div>
                <div class="stat-label">Pengguna Aktif</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">4.8⭐</div>
                <div class="stat-label">Rating</div>
            </div>
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="features-section" id="features">
    <div class="section-title">
        <h2>Fitur Unggulan</h2>
        <p>Nikmati kemudahan mengelola perpustakaan digital dengan fitur-fitur terbaik</p>
    </div>

    <div class="features-grid">
        <div class="feature-card">
            <div class="feature-icon">📚</div>
            <h3>Koleksi Lengkap</h3>
            <p>Akses ribuan buku dari berbagai genre dan kategori. Terus diperbarui dengan koleksi terbaru setiap bulannya.</p>
        </div>

        <div class="feature-card">
            <div class="feature-icon">⏰</div>
            <h3>Monitoring Mudah</h3>
            <p>Pantau status peminjaman buku Anda secara real-time. Notifikasi otomatis untuk tanggal kembali yang akan datang.</p>
        </div>

        <div class="feature-card">
            <div class="feature-icon">📊</div>
            <h3>Statistik & Riwayat</h3>
            <p>Lihat statistik peminjaman Anda dan akses riwayat lengkap semua buku yang pernah dipinjam.</p>
        </div>

        <div class="feature-card">
            <div class="feature-icon">❤️</div>
            <h3>Koleksi Favorit</h3>
            <p>Tandai buku favorit Anda untuk akses cepat. Dapatkan rekomendasi berdasarkan preferensi Anda.</p>
        </div>

        <div class="feature-card">
            <div class="feature-icon">🔔</div>
            <h3>Notifikasi Pintar</h3>
            <p>Dapatkan notifikasi untuk buku baru, penawaran khusus, dan pengingat pengembalian buku.</p>
        </div>

        <div class="feature-card">
            <div class="feature-icon">🔒</div>
            <h3>Keamanan Terjamin</h3>
            <p>Data Anda dilindungi dengan enkripsi tingkat tinggi dan sistem keamanan berlapis.</p>
        </div>
    </div>
</div>

<!-- Books Section -->
<div class="books-section">
    <div class="books-container">
        <div class="section-title">
            <h2>Buku Populer</h2>
            <p>Koleksi buku terpopuler yang sedang dibaca oleh pengguna kami</p>
        </div>

        <div class="books-grid">
            <div class="book-item">📖
                <div class="book-overlay">Laskar Pelangi</div>
            </div>
            <div class="book-item">📖
                <div class="book-overlay">Pergi</div>
            </div>
            <div class="book-item">📖
                <div class="book-overlay">Filosofi Teras</div>
            </div>
            <div class="book-item">📖
                <div class="book-overlay">Pulang</div>
            </div>
            <div class="book-item">📖
                <div class="book-overlay">Tenggelamnya Kapal Van der Wijck</div>
            </div>
            <div class="book-item">📖
                <div class="book-overlay">Bumi</div>
            </div>
        </div>
    </div>
</div>

<!-- Benefits Section -->
<div class="benefits-section">
    <div class="benefits-container">
        <div class="section-title">
            <h2>Mengapa Memilih PinjamBuku?</h2>
            <p>Bergabunglah dengan ribuan pengguna yang telah merasakan manfaatnya</p>
        </div>

        <div class="benefits-grid">
            <div class="benefit-item">
                <h3>✨ Antarmuka Intuitif</h3>
                <p>Desain yang user-friendly memudahkan siapa saja untuk menggunakan platform kami tanpa kesulitan.</p>
            </div>

            <div class="benefit-item">
                <h3>🚀 Proses Cepat</h3>
                <p>Peminjaman buku hanya membutuhkan beberapa klik. Hemat waktu Anda dengan sistem otomatis kami.</p>
            </div>

            <div class="benefit-item">
                <h3>💰 Biaya Terjangkau</h3>
                <p>Nikmati layanan premium dengan harga yang sangat kompetitif. Tidak ada biaya tersembunyi.</p>
            </div>

            <div class="benefit-item">
                <h3>👥 Komunitas Aktif</h3>
                <p>Bergabunglah dengan komunitas pecinta buku. Bagikan ulasan dan rekomendasi dengan pengguna lain.</p>
            </div>
        </div>
    </div>
</div>

<!-- Testimonials -->
<div class="testimonials-section">
    <div class="testimonials-container">
        <div class="section-title">
            <h2>Apa Kata Pengguna Kami</h2>
            <p>Pengalaman nyata dari ribuan pengguna PinjamBuku</p>
        </div>

        <div class="testimonials-grid">
            <div class="testimonial-card">
                <div class="testimonial-stars">⭐⭐⭐⭐⭐</div>
                <div class="testimonial-text">"Aplikasi yang luar biasa! Memudahkan saya untuk meminjam buku favorit tanpa perlu repot ke perpustakaan. Sangat recommended!"</div>
                <div class="testimonial-author">
                    <div class="author-avatar">A</div>
                    <div class="author-info">
                        <h4>Ahmad Rizki</h4>
                        <p>Mahasiswa</p>
                    </div>
                </div>
            </div>

            <div class="testimonial-card">
                <div class="testimonial-stars">⭐⭐⭐⭐⭐</div>
                <div class="testimonial-text">"Interface yang cantik dan mudah digunakan. Tim support juga sangat responsif dan membantu. Terima kasih PinjamBuku!"</div>
                <div class="testimonial-author">
                    <div class="author-avatar">S</div>
                    <div class="author-info">
                        <h4>Siti Nur</h4>
                        <p>Pekerja Kantoran</p>
                    </div>
                </div>
            </div>

            <div class="testimonial-card">
                <div class="testimonial-stars">⭐⭐⭐⭐⭐</div>
                <div class="testimonial-text">"Koleksi buku yang lengkap dan selalu update. Harga terjangkau untuk fitur yang ditawarkan. Sangat puas dengan layanannya."</div>
                <div class="testimonial-author">
                    <div class="author-avatar">R</div>
                    <div class="author-info">
                        <h4>Rahma Putri</h4>
                        <p>Penulis Blog</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="cta-section">
    <div class="cta-content">
        <h2>Siap Memulai Petualangan Membaca?</h2>
        <p>Daftar gratis sekarang dan dapatkan akses ke semua koleksi buku kami</p>
        <a href="{{ route('register') }}" class="cta-button">Daftar Sekarang</a>
    </div>
</div>

<!-- Footer -->
<footer>
    <p>&copy; 2026 PinjamBuku. Semua hak dilindungi. | Sistem Peminjaman Buku Digital Terpercaya</p>
</footer>

</body>
</html>
