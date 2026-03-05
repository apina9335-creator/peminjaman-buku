@extends('layouts.main')

@section('title', 'Pengaturan Akun')

@section('content')
    <div class="page-header">
        <h1>Pengaturan Akun ⚙️</h1>
        <p>Kelola profil dan keamanan akun Anda.</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success">✅ {{ session('success') }}</div>
    @endif

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
        
        <div class="card">
            <div style="font-weight: 700; font-size: 1.2rem; margin-bottom: 1.5rem;">👤 Edit Profil</div>
            <form action="{{ route('settings.update') }}" method="POST">
                @csrf
                <div style="margin-bottom: 1rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ Auth::user()->name }}" style="width: 100%; padding: 0.8rem; border-radius: 0.5rem; border: 1px solid var(--border-color); background: var(--input-bg); color: var(--text-main);">
                </div>
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Alamat Email</label>
                    <input type="email" name="email" value="{{ Auth::user()->email }}" style="width: 100%; padding: 0.8rem; border-radius: 0.5rem; border: 1px solid var(--border-color); background: var(--input-bg); color: var(--text-main);">
                </div>
                <button type="submit" style="background: var(--primary); color: white; padding: 0.8rem 1.5rem; border: none; border-radius: 0.5rem; cursor: pointer; font-weight: 600;">Simpan Perubahan</button>
            </form>
        </div>

        <div class="card">
            <div style="font-weight: 700; font-size: 1.2rem; margin-bottom: 1.5rem;">🔒 Ganti Password</div>
            <form action="{{ route('settings.update-password') }}" method="POST">
                @csrf
                <div style="margin-bottom: 1rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Password Saat Ini</label>
                    <input type="password" name="current_password" style="width: 100%; padding: 0.8rem; border-radius: 0.5rem; border: 1px solid var(--border-color); background: var(--input-bg); color: var(--text-main);">
                </div>
                <div style="margin-bottom: 1rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Password Baru</label>
                    <input type="password" name="new_password" style="width: 100%; padding: 0.8rem; border-radius: 0.5rem; border: 1px solid var(--border-color); background: var(--input-bg); color: var(--text-main);">
                </div>
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Konfirmasi Password Baru</label>
                    <input type="password" name="new_password_confirmation" style="width: 100%; padding: 0.8rem; border-radius: 0.5rem; border: 1px solid var(--border-color); background: var(--input-bg); color: var(--text-main);">
                </div>
                <button type="submit" style="background: var(--warning); color: black; padding: 0.8rem 1.5rem; border: none; border-radius: 0.5rem; cursor: pointer; font-weight: 600;">Update Password</button>
            </form>
        </div>
    </div>
@endsection