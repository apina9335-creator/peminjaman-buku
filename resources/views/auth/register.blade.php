<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar - BookNook</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700,800&display=swap" rel="stylesheet" />

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #3b82f6;
            --primary-dark: #1e40af;
            --primary-light: #dbeafe;
            --secondary: #8b5cf6;
            --danger: #ef4444;
            --gray-600: #4b5563;
            --gray-700: #374151;
            --gray-800: #1f2937;
            --gray-900: #111827;
        }

        html, body {
            font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif;
            background: linear-gradient(135deg, #f0f9ff 0%, #f5f3ff 100%);
            color: var(--gray-800);
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .auth-wrapper {
            width: 100%;
            max-width: 900px;
            display: flex;
            background: white;
            border-radius: 1.5rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            overflow: hidden;
            border: 1px solid #e5e7eb;
        }

        .auth-banner {
            flex: 1;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        /* LOGO SVG BOOKNOOK */
        .logo-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }
        
        .logo-container svg {
            width: 4.5rem;
            height: 4.5rem;
        }

        .logo-container h1 {
            font-size: 2.2rem;
            font-weight: 800;
            letter-spacing: -0.5px;
            margin: 0;
        }

        .auth-banner p {
            font-size: 1.1rem;
            opacity: 0.9;
            max-width: 80%;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            font-weight: 600;
            margin-top: 3rem;
            transition: 0.3s;
            padding: 0.5rem 1rem;
            border: 1px solid rgba(255,255,255,0.3);
            border-radius: 2rem;
        }

        .back-link:hover {
            color: white;
            background: rgba(255,255,255,0.1);
        }

        .register-card {
            flex: 1.2;
            padding: 3rem;
            background: white;
            overflow-y: auto;
            max-height: 90vh; /* Agar scrollable di layar kecil */
        }

        .register-header {
            margin-bottom: 2rem;
        }

        .register-header h2 {
            font-size: 1.8rem;
            color: var(--gray-900);
            margin-bottom: 0.5rem;
            font-weight: 800;
        }

        .register-header p {
            color: var(--gray-600);
            font-size: 0.95rem;
        }

        .form-group {
            margin-bottom: 1.2rem;
        }

        label {
            display: block;
            font-weight: 600;
            color: var(--gray-700);
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="number"],
        input[type="password"] {
            width: 100%;
            padding: 0.8rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 0.75rem;
            font-size: 0.95rem;
            font-family: inherit;
            background: #f9fafb;
            transition: all 0.3s;
            outline: none;
        }

        input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            background: white;
        }

        .error-message {
            color: var(--danger);
            font-size: 0.8rem;
            margin-top: 0.4rem;
            font-weight: 500;
        }

        .form-group.has-error input {
            border-color: var(--danger);
            background: #fef2f2;
        }

        .password-requirements {
            background: #f3f4f6;
            border-left: 4px solid var(--primary);
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
            font-size: 0.85rem;
            color: var(--gray-700);
        }

        .password-requirements ul {
            list-style: none;
            margin-top: 0.5rem;
        }

        .password-requirements li {
            margin-bottom: 0.3rem;
            opacity: 0.8;
        }

        .btn-register {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            border: none;
            border-radius: 0.75rem;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 1rem;
            box-shadow: 0 4px 10px rgba(59, 130, 246, 0.3);
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(59, 130, 246, 0.4);
        }

        .login-link {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.95rem;
            color: var(--gray-600);
        }

        .login-link a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 700;
            transition: 0.3s;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .error-alert {
            background: #fee2e2;
            color: var(--danger);
            border-left: 4px solid var(--danger);
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
            font-size: 0.95rem;
        }

        @media (max-width: 768px) {
            .auth-wrapper {
                flex-direction: column;
            }
            .auth-banner {
                padding: 2rem;
            }
            .register-card {
                padding: 2rem;
                max-height: none;
            }
            .back-link { margin-top: 1.5rem; }
        }
    </style>
</head>
<body>

    <div class="auth-wrapper">
        <div class="auth-banner">
            <div class="logo-container">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                </svg>
                <h1>BookNook</h1>
            </div>
            <p>Bergabunglah dengan komunitas pembaca kami dan temukan ribuan buku menarik.</p>
            <a href="/" class="back-link">← Kembali ke Halaman Utama</a>
        </div>

        <div class="register-card">
            <div class="register-header">
                <h2>Buat Akun</h2>
                <p>Mulai perjalanan membaca Anda bersama kami</p>
            </div>

            @if ($errors->any())
                <div class="error-alert">
                    <strong>Opps! Terjadi kesalahan:</strong>
                    <ul style="margin: 0.5rem 0 0 0; padding-left: 1.5rem;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="/register" novalidate>
                @csrf

                <div class="form-group @error('name') has-error @enderror">
                    <label for="name">Nama Lengkap</label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        value="{{ old('name') }}"
                        placeholder="Masukkan nama lengkap Anda"
                        required
                        autofocus
                    >
                    @error('name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group @error('email') has-error @enderror">
                    <label for="email">Email</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        value="{{ old('email') }}"
                        placeholder="contoh@email.com"
                        required
                    >
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group @error('phone') has-error @enderror">
                    <label for="phone">Nomor Telepon (Opsional)</label>
                    <input 
                        type="tel" 
                        id="phone" 
                        name="phone" 
                        value="{{ old('phone') }}"
                        placeholder="08123456789"
                    >
                    @error('phone')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group @error('nisn') has-error @enderror">
                    <label for="nisn">NISN</label>
                    <input 
                        type="text" 
                        id="nisn" 
                        name="nisn" 
                        value="{{ old('nisn') }}"
                        placeholder="Masukkan NISN (Jika Pelajar)"
                        inputmode="numeric"
                        required
                    >
                    @error('nisn')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group @error('school') has-error @enderror">
                    <label for="school">Asal Sekolah</label>
                    <input 
                        type="text" 
                        id="school" 
                        name="school" 
                        value="{{ old('school') }}"
                        placeholder="Contoh: SMA Negeri 1..."
                        required
                    >
                    @error('school')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="password-requirements">
                    <strong>Persyaratan Password:</strong>
                    <ul>
                        <li>✓ Minimal 8 karakter</li>
                        <li>✓ Kombinasi huruf, angka, dan simbol</li>
                        <li>✓ Jangan gunakan password yang sama</li>
                    </ul>
                </div>

                <div class="form-group @error('password') has-error @enderror">
                    <label for="password">Password</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        placeholder="Buat password yang kuat"
                        required
                    >
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group @error('password_confirmation') has-error @enderror">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <input 
                        type="password" 
                        id="password_confirmation" 
                        name="password_confirmation" 
                        placeholder="Ulangi password Anda"
                        required
                    >
                    @error('password_confirmation')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn-register">Daftar Sekarang</button>
            </form>

            <div class="login-link">
                Sudah punya akun? <a href="/login">Masuk di sini</a>
            </div>
        </div>
    </div>

</body>
</html>