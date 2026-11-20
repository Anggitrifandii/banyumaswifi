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
        Schema::table('pembayarans', function (Blueprint $table) {
            $table->text('keterangan_tolak')->nullable()->after('status_pembayaran');
        });

        DB::statement("ALTER TABLE pembayarans MODIFY COLUMN status_pembayaran ENUM('lunas', 'belum_lunas', 'menunggu', 'ditolak') DEFAULT 'belum_lunas'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("UPDATE pembayarans SET status_pembayaran = 'belum_lunas' WHERE status_pembayaran = 'ditolak'");
        DB::statement("ALTER TABLE pembayarans MODIFY COLUMN status_pembayaran ENUM('lunas', 'belum_lunas', 'menunggu') DEFAULT 'belum_lunas'");

        Schema::table('pembayarans', function (Blueprint $table) {
            $table->dropColumn('keterangan_tolak');
        });
    }
};
