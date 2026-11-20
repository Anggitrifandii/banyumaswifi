<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogAktivitas extends Model
{
    protected $table = 'log_aktivitas';
    protected $fillable = ['user_id', 'modul', 'aksi', 'keterangan'];

    // Relasi untuk mengetahui nama staf yang melakukan aksi
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}