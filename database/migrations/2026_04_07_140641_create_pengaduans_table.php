<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengaduans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelanggan_id')->constrained('pelanggans')->onDelete('cascade');
            $table->string('jenis_gangguan');
            $table->text('deskripsi')->nullable();
            $table->enum('status_tiket', ['Menunggu Teknisi', 'Sedang Diperbaiki', 'Selesai'])->default('Menunggu Teknisi');
            $table->date('tanggal_lapor');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengaduans');
    }
};