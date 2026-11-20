<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
    protected $table = 'inventaris';

    // PERBAIKAN: Menggunakan $fillable agar _token dari form tidak ikut terkirim ke database
    protected $fillable = [
        'nama_perangkat',
        'kategori',
        'stok',
        'kondisi',
        'keterangan'
    ];
}