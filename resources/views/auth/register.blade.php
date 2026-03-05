<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar - PinjamBuku</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600&display=swap" rel="stylesheet" />

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
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: var(--gray-800);
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .register-container {
            width: 100%;
            max-width: 500px;
            padding: 2rem;
        }

        .register-card {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            padding: 2.5rem;
        }

        .register-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .logo-header {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
        }

        .logo-icon {
            width: 2.5rem;
            height: 2.5rem;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
        }

        .logo-text {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--primary);
        }

        .register-header h1 {
            font-size: 1.75rem;
            color: var(--gray-900);
            margin-bottom: 0.5rem;
        }

        .register-header p {
            color: var(--gray-600);
            font-size: 0.95rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            font-weight: 500;
            color: var(--gray-700);
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="number"],
        input[type="password"] {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 0.5rem;
            font-size: 1rem;
            font-family: inherit;
            transition: all 0.3s;
        }

        input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .error-message {
            color: var(--danger);
            font-size: 0.85rem;
            margin-top: 0.5rem;
        }

        .form-group.has-error input {
            border-color: var(--danger);
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
            margin: 0;
            padding: 0;
        }

        .password-requirements li {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.5rem;
        }

        .btn-register {
            width: 100%;
            padding: 0.875rem 1.5rem;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            border: none;
            border-radius: 0.5rem;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 0.5rem;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(59, 130, 246, 0.4);
        }

        .login-link {
            text-align: center;
            margin-top: 1.5rem;
            color: var(--gray-600);
        }

        .login-link a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s;
        }

        .login-link a:hover {
            color: var(--primary-dark);
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

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: white;
            text-decoration: none;
            margin-bottom: 2rem;
            font-weight: 500;
            transition: opacity 0.3s;
        }

        .back-link:hover {
            opacity: 0.8;
        }

        @media (max-width: 640px) {
            .register-container {
                padding: 1rem;
            }

            .register-card {
                padding: 1.5rem;
            }

            .register-header h1 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <a href="/" class="back-link">← Kembali ke Home</a>

        <div class="register-card">
            <div class="register-header">
                <div class="logo-header">
                    <div class="logo-icon">📚</div>
                    <div class="logo-text">PinjamBuku</div>
                </div>
                <h1>Buat Akun</h1>
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
                        placeholder="Masukkan email Anda"
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
                        placeholder="Masukkan nomor telepon Anda"
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
                        placeholder="Masukkan NISN Anda"
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
                        placeholder="Masukkan asal sekolah Anda"
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
                        placeholder="Masukkan password Anda"
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
                        placeholder="Konfirmasi password Anda"
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