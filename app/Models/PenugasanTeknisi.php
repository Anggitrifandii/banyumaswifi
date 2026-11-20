<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenugasanTeknisi extends Model
{
    protected $table = 'penugasan_teknisis';
    protected $fillable = ['teknisi_id', 'judul_tugas', 'lokasi_alamat', 'jenis_tugas', 'status', 'jadwal_kunjungan', 'catatan'];

    public function teknisi()
    {
        return $this->belongsTo(Teknisi::class, 'teknisi_id');
    }
}