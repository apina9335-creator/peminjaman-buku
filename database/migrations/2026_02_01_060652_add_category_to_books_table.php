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
        Schema::table('books', function (Blueprint $table) {
            // Cek dulu, kalau kolom category belum ada, baru dibuat
            if (!Schema::hasColumn('books', 'category')) {
                $table->string('category')->nullable()->after('author');
            }
            
            // Cek dulu, kalau kolom cover_image belum ada, baru dibuat
            if (!Schema::hasColumn('books', 'cover_image')) {
                $table->string('cover_image')->nullable()->after('stock');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn(['category', 'cover_image']);
        });
    }
};