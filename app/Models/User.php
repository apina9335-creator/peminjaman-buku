<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'nisn',
        'school',
        'phone',
        'is_admin',        // <-- WAJIB TAMBAH INI agar bisa login admin
        'role',            // Opsional (jika masih pakai kolom role)
        'theme',
        'language',
        'items_per_page',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean', // Memastikan is_admin dibaca sebagai true/false
        ];
    }

    /**
     * Helper untuk mengecek admin (Bisa digunakan di Blade/Controller)
     */
    public function isAdmin(): bool
    {
        return (bool) $this->is_admin;
    }

    // Tambahkan baris ini di dalam class User
public function favorites()
{
    return $this->belongsToMany(Book::class, 'favorites', 'user_id', 'book_id')->withTimestamps();
}

}