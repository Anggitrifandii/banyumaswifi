<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pelanggans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade'); // PENGHUBUNG AKUN
            $table->string('nama');
            $table->text('alamat')->nullable(); // Boleh kosong saat awal daftar
            $table->string('no_hp')->nullable(); 
            $table->foreignId('paket_id')->nullable()->constrained('pakets')->onDelete('cascade'); // Boleh kosong menunggu ACC
            $table->date('tanggal_pasang');
            $table->enum('status', ['aktif', 'nonaktif'])->default('nonaktif'); // Default nonaktif sebelum di-ACC Admin
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pelanggans');
    }
};