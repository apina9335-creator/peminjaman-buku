<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id(); // Ini akan jadi referensi 'book_id'
            $table->string('title');
            $table->string('author');
            $table->text('description')->nullable();
            $table->string('publisher')->nullable();
            $table->integer('year')->nullable();
            $table->integer('stock')->default(0); // Penting untuk peminjaman
            $table->string('cover_image')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};