<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Pelanggan extends Model
{
    protected $fillable = ['user_id', 'nama', 'alamat', 'no_hp', 'paket_id', 'tanggal_pasang', 'status'];
    
    protected $appends = ['tanggal_jatuh_tempo', 'status_tagihan_bulan_ini'];

    public function user() { return $this->belongsTo(User::class); }
    public function paket() { return $this->belongsTo(Paket::class); }
    public function pembayarans() { return $this->hasMany(Pembayaran::class); }
    public function pengaduans() { return $this->hasMany(Pengaduan::class); }
    public function vouchers() { return $this->hasMany(Voucher::class); }

    // LOGIKA JATUH TEMPO
    public function getTanggalJatuhTempoAttribute()
    {
        $pembayaranTerakhir = $this->pembayarans()->where('status_pembayaran', 'lunas')->latest('tanggal_bayar')->first();

        $tanggalAcuan = $pembayaranTerakhir 
                        ? Carbon::parse($pembayaranTerakhir->tanggal_bayar)->startOfDay()
                        : Carbon::parse($this->tanggal_pasang)->startOfDay();

        return $tanggalAcuan->addMonth();
    }

    // LOGIKA STATUS TAGIHAN (SUDAH DIPERBAIKI TOTAL)
    public function getStatusTagihanBulanIniAttribute()
    {
        if ($this->status == 'nonaktif') return 'Nonaktif';

        $now = Carbon::now()->startOfDay();

        // Cari riwayat bayar terakhir
        $pembayaranTerakhir = $this->pembayarans()->where('status_pembayaran', 'lunas')->latest('tanggal_bayar')->first();

        // JIKA SUDAH PERNAH BAYAR
        if ($pembayaranTerakhir) {
            $tanggalAcuan = Carbon::parse($pembayaranTerakhir->tanggal_bayar)->startOfDay();
            $tanggalJatuhTempo = (clone $tanggalAcuan)->addMonth();

            if ($now->greaterThan($tanggalJatuhTempo)) {
                return 'Belum Bayar';
            } else {
                return 'Lunas';
            }
        }

        // JIKA BELUM PERNAH BAYAR TAPI STATUS AKTIF
        return 'Belum Bayar';
    }
}