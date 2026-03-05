<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('users', function (Blueprint $table) {
        $table->timestamp('penalty_until')->nullable()->after('password'); // Sampai kapan dilarang pinjam
        $table->integer('violation_count')->default(0)->after('penalty_until'); // Jumlah pelanggaran
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn(['penalty_until', 'violation_count']);
    });

    }
};
