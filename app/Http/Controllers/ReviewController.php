<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        // Cek apakah user sudah pernah review buku ini (Opsional, agar tidak spam)
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
}