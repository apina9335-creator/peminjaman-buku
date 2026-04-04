<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    protected $fillable = ['user_id', 'book_id', 'text'];

    // Relasi ke User (Siapa yang posting)
    public function user() {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Buku (Kutipan dari buku apa)
    public function book() {
        return $this->belongsTo(Book::class);
    }
}