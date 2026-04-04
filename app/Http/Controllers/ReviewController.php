<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\ReviewLike;   // <-- TAMBAHAN IMPORT MODEL LIKE
use App\Models\ReviewReply;  // <-- TAMBAHAN IMPORT MODEL REPLY
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    // Fungsi untuk menyimpan ulasan baru
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        // Cek apakah user sudah pernah review buku ini (agar tidak spam)
        $existingReview = Review::where('user_id', Auth::id())
                                ->where('book_id', $request->book_id)
                                ->first();

        if ($existingReview) {
            return back()->with('error', 'Anda sudah memberikan ulasan untuk buku ini.');
        }

        Review::create([
            'user_id' => Auth::id(),
            'book_id' => $request->book_id,
            'rating' => $request->rating,
            'comment' => $request->comment
        ]);

        return back()->with('success', 'Terima kasih atas ulasan Anda!');
    }

    // ==========================================
    // BAGIAN TAMBAHAN: FUNGSI LIKE & REPLY
    // ==========================================

    public function toggleLike($id)
    {
        $userId = Auth::id();
        
        // Cari apakah user sudah pernah nge-like review ini
        $like = ReviewLike::where('user_id', $userId)
                          ->where('review_id', $id)
                          ->first();

        if ($like) {
            // Jika sudah di-like, maka batalkan like (hapus dari database)
            $like->delete();
        } else {
            // Jika belum di-like, tambahkan like ke database
            ReviewLike::create([
                'user_id' => $userId, 
                'review_id' => $id
            ]);
        }

        // Return ke halaman detail buku secara diam-diam
        return back();
    }

    public function storeReply(Request $request, $id)
    {
        $request->validate([
            'reply_text' => 'required|string|max:500'
        ]);

        // Simpan balasan komentar ke database
        ReviewReply::create([
            'user_id' => Auth::id(),
            'review_id' => $id,
            'reply_text' => $request->reply_text
        ]);

        return back()->with('success', 'Balasan komentar berhasil dikirim ke komunitas!');
    }
}