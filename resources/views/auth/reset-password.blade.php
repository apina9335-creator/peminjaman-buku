<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Buat Password Baru - BookNook</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700,800&display=swap" rel="stylesheet" />
    <style>
        :root { --primary: #3b82f6; --primary-dark: #1e40af; --bg-body: linear-gradient(135deg, #f0f9ff 0%, #f5f3ff 100%); --bg-card: #ffffff; --text-main: #1f2937; --text-muted: #6b7280; --danger: #ef4444; }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Instrument Sans', sans-serif; }
        body { background: var(--bg-body); color: var(--text-main); display: flex; align-items: center; justify-content: center; min-height: 100vh; padding: 2rem; }
        .auth-wrapper { width: 100%; max-width: 500px; background: white; border-radius: 1.5rem; box-shadow: 0 10px 30px rgba(0,0,0,0.08); padding: 3rem; text-align: center; }
        h2 { font-size: 1.8rem; font-weight: 800; margin-bottom: 0.5rem; }
        p { color: var(--text-muted); font-size: 0.95rem; margin-bottom: 2rem; }
        .form-group { text-align: left; margin-bottom: 1.5rem; }
        label { font-weight: 600; font-size: 0.9rem; display: block; margin-bottom: 0.5rem; }
        input { width: 100%; padding: 0.8rem 1rem; border: 2px solid #e5e7eb; border-radius: 0.75rem; outline: none; transition: 0.3s; background: #f9fafb; font-family: inherit;}
        input:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1); background: white;}
        .btn-submit { width: 100%; padding: 1rem; background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); color: white; border: none; border-radius: 0.75rem; font-weight: 700; cursor: pointer; transition: 0.3s; }
        .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 6px 15px rgba(59, 130, 246, 0.4); }
        .error-message { color: var(--danger); font-size: 0.8rem; margin-top: 0.4rem; font-weight: 500; text-align: left; }
    </style>
</head>
<body>
    <div class="auth-wrapper">
        <h2>Buat Password Baru 🔒</h2>
        <p>Silakan masukkan password baru Anda.</p>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group">
                <label for="email">Alamat Email</label>
                <input type="email" name="email" id="email" value="{{ request()->email ?? old('email') }}" readonly style="background: #e5e7eb; cursor: not-allowed;">
                @error('email') <div class="error-message">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="password">Password Baru</label>
                <input type="password" name="password" id="password" required autofocus placeholder="Minimal 8 karakter">
                @error('password') <div class="error-message">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required placeholder="Ulangi password baru">
            </div>

            <button type="submit" class="btn-submit">Simpan & Login</button>
        </form>
    </div>
</body>
</html>