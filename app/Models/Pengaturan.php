<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaturan extends Model
{
    protected $table = 'pengaturans';

    protected $fillable = [
        'nama_aplikasi',
        'nama_perusahaan',
        'no_telp',
        'alamat',
        'pesan_sambutan'
    ];
}