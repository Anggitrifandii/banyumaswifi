<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE pembayarans MODIFY COLUMN status_pembayaran ENUM('lunas', 'belum_lunas', 'menunggu') DEFAULT 'belum_lunas'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Hindari error pada rollback jika masih ada data dengan nilai 'menunggu'
        DB::statement("UPDATE pembayarans SET status_pembayaran = 'belum_lunas' WHERE status_pembayaran = 'menunggu'");
        DB::statement("ALTER TABLE pembayarans MODIFY COLUMN status_pembayaran ENUM('lunas', 'belum_lunas') DEFAULT 'belum_lunas'");
    }
};
