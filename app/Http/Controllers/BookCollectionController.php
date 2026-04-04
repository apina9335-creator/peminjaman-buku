<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class BookCollectionController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();

        $books = Book::withAvg('reviews', 'rating')
                     ->withCount('reviews')
                     ->get()
                     ->map(function ($book) {
                         return [
                             'id' => $book->id,
                             'title' => $book->title,
                             'author' => $book->author,
                             'category' => $book->category ?? 'Umum',
                             'cover_image' => $book->cover_image, 
                             'available' => $book->stock > 0,
                             'stock' => $book->stock,
                             'description' => $book->description,
                             'spoiler' => $book->spoiler, 
                             'reviews' => $book->reviews_count, 
                             'rating' => round($book->reviews_avg_rating, 1) ?: 0, 
                         ];
                     });

        return view('koleksi-buku', compact('user', 'books'));
    }

    public function show($id)
    {
        $user = Auth::user();
        
        // === PERBAIKAN: Tambahkan 'reviews.likes' dan 'reviews.replies.user' di sini ===
        $book = Book::with(['reviews.user', 'reviews.likes', 'reviews.replies.user'])->findOrFail($id);

        $recommendations = Book::where('category', $book->category)
                               ->where('id', '!=', $book->id)
                               ->inRandomOrder()
                               ->take(4)
                               ->get();

        return view('detail-buku', compact('user', 'book', 'recommendations'));
    }
}