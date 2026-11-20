<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    // Tambahkan 'balasan_admin' ke dalam fillable
    protected $fillable = ['pelanggan_id', 'jenis_gangguan', 'deskripsi', 'balasan_admin', 'status_tiket', 'tanggal_lapor'];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }
}