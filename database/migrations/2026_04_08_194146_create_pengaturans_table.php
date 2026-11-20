<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengaturans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_aplikasi')->default('BanyumasWiFi');
            $table->string('nama_perusahaan')->default('PT. Banyumas LDP');
            $table->string('no_telp')->default('081234567890');
            $table->text('alamat')->nullable();
            $table->text('pesan_sambutan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengaturans');
    }
};