<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

// Tambahan Library untuk Reset Password
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    // === 1. FORM LOGIN ===
    public function loginForm(): View
    {
        return view('auth.login');
    }

    // === 2. PROSES LOGIN (VERSI FINAL & FIKS) ===
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Coba Login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if ((int) Auth::user()->is_admin === 1) {
                return redirect()->route('admin.dashboard'); 
            }

            // Untuk user biasa, boleh pakai intended (biar nyaman)
            return redirect()->intended(route('dashboard'));
        }

        // Jika Login Gagal
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    // === 3. FORM REGISTER ===
    public function registerForm(): View
    {
        return view('auth.register');
    }

    // === 4. PROSES REGISTER ===
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'nullable|string|max:20',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'password' => bcrypt($validated['password']),
            // Set default user biasa (bukan admin)
            'is_admin' => 0, 
        ]);

        // Kirim event registered (untuk verifikasi email jika aktif)
        event(new Registered($user));

        // Langsung login setelah register
        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Registrasi berhasil!');
    }

    // === 5. PROSES LOGOUT ===
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    // ==========================================
    // === 6. FITUR LUPA PASSWORD (RESET) ===
    // ==========================================

    // Menampilkan form masukkan email
    public function forgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    // Mengirim link reset password ke email
    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
    }

    // Menampilkan form buat password baru
    public function resetPasswordForm(Request $request, $token)
    {
        return view('auth.reset-password', ['token' => $token, 'email' => $request->email]);
    }

    // Menyimpan password baru ke database
    public function updatePassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();
            }
        );

        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('success', 'Password Anda telah berhasil direset. Silakan login!')
                    : back()->withErrors(['email' => [__($status)]]);
    }
}