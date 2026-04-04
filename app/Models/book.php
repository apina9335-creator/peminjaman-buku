<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'description',
        'category', 
        'publisher',
        'year',
        'stock',
        'cover_image',
        'spoiler',
    ];

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    public function reviews()
{
    return $this->hasMany(Review::class);
}
}