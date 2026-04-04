<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuoteController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'text' => 'required|string|max:500'
        ]);

        Quote::create([
            'user_id' => Auth::id(),
            'book_id' => $request->book_id,
            'text' => $request->text
        ]);

        return back()->with('success', 'Kutipan inspiratifmu berhasil dibagikan ke komunitas!');
    }
}