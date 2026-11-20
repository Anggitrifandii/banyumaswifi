<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pelanggan; // Wajib dipanggil agar tidak error Class Not Found

class Paket extends Model
{
    use HasFactory;

    protected $table = 'pakets'; // Definisi nama tabel eksplisit

    protected $fillable = [
        'nama_paket', 
        'kecepatan', 
        'harga'
    ];

    // Relasi eksplisit Anti-Error
    public function pelanggans()
    {
        return $this->hasMany(Pelanggan::class, 'paket_id', 'id');
    }
}