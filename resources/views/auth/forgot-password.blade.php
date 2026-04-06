<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lupa Password - BookNook</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700,800&display=swap" rel="stylesheet" />
    <style>
        :root { --primary: #3b82f6; --primary-dark: #1e40af; --bg-body: linear-gradient(135deg, #f0f9ff 0%, #f5f3ff 100%); --bg-card: #ffffff; --text-main: #1f2937; --text-muted: #6b7280; --danger: #ef4444; --success: #10b981; }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Instrument Sans', sans-serif; }
        body { background: var(--bg-body); color: var(--text-main); display: flex; align-items: center; justify-content: center; min-height: 100vh; padding: 2rem; }
        .auth-wrapper { width: 100%; max-width: 500px; background: white; border-radius: 1.5rem; box-shadow: 0 10px 30px rgba(0,0,0,0.08); padding: 3rem; text-align: center; }
        .auth-logo svg { width: 4rem; height: 4rem; color: var(--primary); margin-bottom: 1rem; }
        h2 { font-size: 1.8rem; font-weight: 800; margin-bottom: 0.5rem; }
        p { color: var(--text-muted); font-size: 0.95rem; margin-bottom: 2rem; }
        .form-group { text-align: left; margin-bottom: 1.5rem; }
        label { font-weight: 600; font-size: 0.9rem; display: block; margin-bottom: 0.5rem; }
        input { width: 100%; padding: 0.8rem 1rem; border: 2px solid #e5e7eb; border-radius: 0.75rem; outline: none; transition: 0.3s; background: #f9fafb; font-family: inherit;}
        input:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1); background: white;}
        .btn-submit { width: 100%; padding: 1rem; background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); color: white; border: none; border-radius: 0.75rem; font-weight: 700; cursor: pointer; transition: 0.3s; margin-bottom: 1.5rem; }
        .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 6px 15px rgba(59, 130, 246, 0.4); }
        .back-link { color: var(--primary); text-decoration: none; font-weight: 600; }
        .back-link:hover { text-decoration: underline; }
        .alert { padding: 1rem; border-radius: 0.5rem; margin-bottom: 1.5rem; font-size: 0.9rem; text-align: left; }
        .alert-success { background: #d1fae5; color: #065f46; border-left: 4px solid var(--success); }
        .alert-danger { background: #fee2e2; color: #991b1b; border-left: 4px solid var(--danger); }
    </style>
</head>
<body>
    <div class="auth-wrapper">
        <div class="auth-logo">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
            </svg>
        </div>
        <h2>Lupa Password?</h2>
        <p>Masukkan alamat email Anda, dan kami akan mengirimkan tautan untuk mereset password Anda.</p>

        @if (session('status'))
            <div class="alert alert-success">✅ {{ session('status') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">❌ {{ $errors->first('email') }}</div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="form-group">
                <label for="email">Alamat Email</label>
                <input type="email" name="email" id="email" required autofocus placeholder="contoh@email.com" value="{{ old('email') }}">
            </div>
            <button type="submit" class="btn-submit">Kirim Tautan Reset Password</button>
        </form>

        <a href="{{ route('login') }}" class="back-link">← Kembali ke Login</a>
    </div>
</body>
</html>