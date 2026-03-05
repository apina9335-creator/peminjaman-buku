<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class BookCollectionController extends Controller
{
    /**
     * Menampilkan koleksi buku dari database.
     */
   public function index(): View
{
    $user = Auth::user();

    // Ambil buku beserta rata-rata rating dan jumlah review
    $books = Book::withAvg('reviews', 'rating') // Menghasilkan kolom reviews_avg_rating
                 ->withCount('reviews')         // Menghasilkan kolom reviews_count
                 ->get()
                 ->map(function ($book) {
                     return [
                         'id' => $book->id,
                         'title' => $book->title,
                         'author' => $book->author,
                         'category' => $book->category ?? 'Umum',
                         'cover_image' => $book->cover_image, 
                         'available' => $book->stock > 0,
                         // Gunakan data asli (jika null, default ke 0)
                         'reviews' => $book->reviews_count, 
                         'rating' => round($book->reviews_avg_rating, 1) ?: 0, 
                     ];
                 });

    return view('koleksi-buku', compact('user', 'books'));
}
}