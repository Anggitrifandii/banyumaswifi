<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teknisi extends Model
{
    protected $table = 'teknisis';
    protected $fillable = ['nama', 'no_telp', 'email'];

    public function penugasans()
    {
        return $this->hasMany(PenugasanTeknisi::class, 'teknisi_id');
    }
}