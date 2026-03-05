<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class AdminReviewController extends Controller
{
    // Menampilkan daftar semua ulasan
    public function index()
    {
        // Ambil review urut dari yang terbaru, beserta data user dan bukunya
        $reviews = Review::with(['user', 'book'])->latest()->paginate(10);
        
        return view('admin.reviews.index', compact('reviews'));
    }

    // Menghapus ulasan yang tidak pantas
    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return back()->with('success', 'Ulasan berhasil dihapus.');
    }
}