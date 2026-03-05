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
    Schema::table('loans', function (Blueprint $table) {
        // Tambahkan kolom notes setelah return_date, boleh kosong (nullable)
        $table->text('notes')->nullable()->after('return_date');
    });
}

public function down(): void
{
    Schema::table('loans', function (Blueprint $table) {
        $table->dropColumn('notes');
    });
}
};
