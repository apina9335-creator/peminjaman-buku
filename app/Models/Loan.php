<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    // --- BAGIAN INI KUNCINYA ---
    protected $fillable = [
        'user_id',
        'book_id',
        'loan_date',
        'return_date',
        'status', // <--- WAJIB ADA
        'notes',  // <--- WAJIB ADA
    ];
    // ---------------------------

    protected $casts = [
        'loan_date' => 'date',
        'return_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}