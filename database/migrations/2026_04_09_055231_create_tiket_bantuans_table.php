<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tiket_bantuans', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_tiket')->unique();
            $table->unsignedBigInteger('pelanggan_id')->nullable(); // Relasi ke pelanggan
            $table->string('subjek');
            $table->text('deskripsi');
            $table->enum('prioritas', ['Low', 'Medium', 'High', 'Critical'])->default('Medium');
            $table->enum('status', ['Open', 'In Progress', 'Resolved', 'Closed'])->default('Open');
            $table->timestamp('batas_waktu_sla')->nullable(); // Waktu deadline perbaikan
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tiket_bantuans');
    }
};