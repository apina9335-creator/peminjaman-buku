<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookCollectionController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\AdminLoanController;
use App\Http\Controllers\AdminBookController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AdminReviewController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuoteController;

// Import class untuk verifikasi email
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

// 1. HALAMAN UTAMA
Route::get('/', function () {
    return view('welcome');
});

// 2. RUTE AUTH (Guest - Belum Login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ==========================================================
// RUTE VERIFIKASI EMAIL (LENGKAP & FIX ERROR)
// ==========================================================
Route::middleware(['auth'])->group(function () {

    // 1. Halaman Pemberitahuan (FIX ERROR verification.notice)
    Route::get('/email/verify', function () {
        return view('auth.verify-email'); 
    })->name('verification.notice');

    // 2. Link verifikasi yang diklik dari email
    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill(); // Tandai email sbg verified
        return redirect('/dashboard')->with('success', 'Email berhasil diverifikasi! Selamat datang.');
    })->middleware('signed')->name('verification.verify');

    // 3. Link untuk kirim ulang email verifikasi
    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('success', 'Link verifikasi telah dikirim ulang ke email Anda!');
    })->middleware('throttle:6,1')->name('verification.send');

    // Profil User
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
});


// 3. RUTE USER BIASA (Wajib Login & Wajib Verified)
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Fitur Utama (Koleksi & Detail Buku)
    Route::get('/koleksi-buku', [BookCollectionController::class, 'index'])->name('books.collection');
    Route::get('/buku/{id}', [BookCollectionController::class, 'show'])->name('books.show');
    
    // === RUTE PEMINJAMAN ===
    Route::get('/peminjaman', [LoanController::class, 'index'])->name('loans');
    Route::post('/peminjaman', [LoanController::class, 'store'])->name('loans.store');
    Route::post('/peminjaman/{id}/return', [LoanController::class, 'returnBook'])->name('loans.return');
    
    // Menu Tambahan
    Route::get('/riwayat', [HistoryController::class, 'index'])->name('history');
    
    // Favorit
    Route::get('/favorit', [FavoritesController::class, 'index'])->name('favorites');
    Route::post('/favorit/toggle', [FavoritesController::class, 'toggle'])->name('favorites.toggle');
    
    // Pengaturan
    Route::get('/pengaturan', [SettingsController::class, 'index'])->name('settings');
    Route::post('/pengaturan', [SettingsController::class, 'update'])->name('settings.update');
    Route::post('/pengaturan/password', [SettingsController::class, 'updatePassword'])->name('settings.update-password');

    // ==========================================
    // FITUR KOMUNITAS (Quotes, Review, Like, Reply)
    // ==========================================
    Route::post('/quotes', [QuoteController::class, 'store'])->name('quotes.store');
    
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::post('/reviews/{id}/like', [ReviewController::class, 'toggleLike'])->name('reviews.like');
    Route::post('/reviews/{id}/reply', [ReviewController::class, 'storeReply'])->name('reviews.reply');
});

// 4. KHUSUS ADMIN
Route::middleware(['auth', 'verified', 'is_admin'])->group(function () {
    
    // === DASHBOARD ADMIN (DENGAN LOGIKA HITUNG DATA) ===
    Route::get('/admin/dashboard', function () {
        // Hitung data real-time dari database
        $bookCount = \App\Models\Book::count();
        $userCount = \App\Models\User::where('is_admin', 0)->count();
        $activeLoansCount = \App\Models\Loan::whereIn('status', ['borrowed', 'overdue'])->count();
        $pendingLoansCount = \App\Models\Loan::where('status', 'pending')->count();
        $reviewsCount = \App\Models\Review::count();

        // Kirim data ke view
        return view('admin.dashboard', compact('bookCount', 'userCount', 'activeLoansCount', 'pendingLoansCount', 'reviewsCount'));
    })->name('admin.dashboard');

    // Manajemen Buku
    Route::get('/admin/books/create', [AdminBookController::class, 'create'])->name('admin.books.create');
    Route::post('/admin/books/store', [AdminBookController::class, 'store'])->name('admin.books.store');
    Route::get('/admin/books/{book}/edit', [AdminBookController::class, 'edit'])->name('admin.books.edit');
    Route::put('/admin/books/{book}', [AdminBookController::class, 'update'])->name('admin.books.update');
    Route::delete('/admin/books/{book}', [AdminBookController::class, 'destroy'])->name('admin.books.destroy');

    // Validasi Peminjaman
    Route::get('/admin/peminjaman', [AdminLoanController::class, 'index'])->name('admin.loans.index');
    Route::post('/admin/peminjaman/{id}/approve', [AdminLoanController::class, 'approve'])->name('admin.loans.approve');
    Route::post('/admin/peminjaman/{id}/reject', [AdminLoanController::class, 'reject'])->name('admin.loans.reject');

    // === MONITORING & PENGEMBALIAN OLEH ADMIN ===
    Route::get('/admin/peminjaman/aktif', [AdminLoanController::class, 'activeLoans'])->name('admin.loans.active');
    Route::post('/admin/peminjaman/{id}/return', [AdminLoanController::class, 'adminReturn'])->name('admin.loans.return');

    // Manajemen Ulasan
    Route::get('/admin/reviews', [AdminReviewController::class, 'index'])->name('admin.reviews.index');
    Route::delete('/admin/reviews/{id}', [AdminReviewController::class, 'destroy'])->name('admin.reviews.destroy');

    // Manajemen User
    Route::get('/admin/users', [AdminUserController::class, 'index'])->name('admin.users.index');
    Route::delete('/admin/users/{id}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');
});