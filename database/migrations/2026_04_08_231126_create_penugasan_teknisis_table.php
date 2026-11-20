<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penugasan_teknisis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('teknisi_id')->nullable(); // Kolom relasi ke teknisi
            $table->string('judul_tugas');
            $table->string('lokasi_alamat');
            $table->enum('jenis_tugas', ['Instalasi Baru', 'Perbaikan Gangguan', 'Tarik Kabel', 'Maintenance'])->default('Instalasi Baru');
            $table->enum('status', ['Menunggu', 'Sedang Dikerjakan', 'Selesai'])->default('Menunggu');
            $table->date('jadwal_kunjungan');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penugasan_teknisis');
    }
};