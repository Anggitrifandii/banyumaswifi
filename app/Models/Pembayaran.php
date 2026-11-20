<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    // INI KUNCI UNTUK MENGATASI ERROR MASS ASSIGNMENT
    protected $fillable = [
        'pelanggan_id', 
        'bulan_tagihan', 
        'jumlah_bayar', 
        'tanggal_bayar', 
        'status_pembayaran',
        'bukti_pembayaran',
        'keterangan_tolak'
    ];

    // Relasi balik ke Pelanggan
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }
}