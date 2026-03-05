<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke User (Peminjam)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Relasi ke Buku (PENTING: Pakai foreignId agar terhubung ke tabel books)
            // Dengan ini kita tidak perlu simpan judul/author manual, cukup ambil dari relasi
            $table->foreignId('book_id')->constrained()->onDelete('cascade');

            $table->date('loan_date'); // Tanggal Pinjam
            $table->date('return_date'); // Rencana Tanggal Kembali (Batas Waktu)
            
            // Kolom Status (Kunci Fitur Admin Approval)
            // pending  = Menunggu persetujuan admin
            // borrowed = Sedang dipinjam (sudah disetujui)
            // returned = Sudah dikembalikan
            // rejected = Ditolak admin
            $table->enum('status', ['pending', 'borrowed', 'returned', 'rejected'])
                  ->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};