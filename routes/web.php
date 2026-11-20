<?php

use App\Http\Controllers\BusinessIntelligenceController;
use App\Http\Controllers\TeknisiController;
use App\Http\Controllers\PenugasanTeknisiController;
use App\Http\Controllers\LogAktivitasController;
use App\Http\Controllers\ManajemenStafController;
use App\Http\Controllers\BossController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\AkunPelangganController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\InventarisController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\LaporanController;
use App\Models\Pelanggan;
use App\Models\Paket;
use App\Models\Pembayaran;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

Route::get('/', function () {
    $pakets = Paket::all();
    return view('welcome', compact('pakets'));
});

Route::get('/dashboard', function () {
    $role = Auth::user()->role; 
    if ($role === 'admin') return redirect()->route('admin.dashboard'); 
    elseif ($role === 'boss') return redirect()->route('boss.dashboard'); 
    else return redirect()->route('client.dashboard'); 
})->middleware(['auth', 'verified'])->name('dashboard');

// ==========================================
// 🔴 ZONA KHUSUS ADMIN
// ==========================================
Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        $totalPelanggan = Pelanggan::count();
        $pelangganAktif = Pelanggan::where('status', 'aktif')->count();
        $totalPaket = Paket::count();
        $pelanggans = Pelanggan::with('paket')->where('status', 'aktif')->get();
        $pendapatanBulanIni = 0;
        
        foreach ($pelanggans as $p) {
            if (strtoupper($p->status_tagihan_bulan_ini) === 'LUNAS') {
                $pendapatanBulanIni += $p->paket?->harga ?? 0;
            }
        }
        
        $pakets = Paket::all();
        $chartLabels = [];
        $chartData = [];
        foreach($pakets as $paket) {
            $chartLabels[] = $paket->nama_paket;
            $chartData[] = Pelanggan::where('paket_id', $paket->id)->where('status', 'aktif')->count();
        }
        
        $pelangganMonitoring = $pelanggans;
        
        return view('dashboard', compact('totalPelanggan', 'pelangganAktif', 'totalPaket', 'pendapatanBulanIni', 'chartLabels', 'chartData', 'pelangganMonitoring'));
    })->name('admin.dashboard');

    Route::resource('pelanggan', PelangganController::class);
    Route::resource('paket', PaketController::class);
    Route::resource('pembayaran', PembayaranController::class);
    Route::post('/pembayaran/{id}/kirim-tagihan', [PembayaranController::class, 'kirimTagihan'])->name('pembayaran.kirim-tagihan');
    Route::put('/pembayaran/{id}/konfirmasi', [PembayaranController::class, 'konfirmasi'])->name('pembayaran.konfirmasi');
    Route::put('/pembayaran/{id}/tolak', [PembayaranController::class, 'tolak'])->name('pembayaran.tolak');
    
    Route::post('/pengaduan/broadcast', [PengaduanController::class, 'broadcast'])->name('pengaduan.broadcast');
    Route::resource('pengaduan', PengaduanController::class);
    Route::resource('inventaris', InventarisController::class);
    
    Route::get('/pengaturan', [PengaturanController::class, 'index'])->name('pengaturan.index');
    Route::put('/pengaturan/update', [PengaturanController::class, 'update'])->name('pengaturan.update');
    Route::get('/akun-pelanggan', [AkunPelangganController::class, 'index'])->name('akun.index');
    Route::put('/akun-pelanggan/update/{id}', [AkunPelangganController::class, 'update'])->name('akun.update');
    
    Route::get('/pengumuman', [PengumumanController::class, 'index'])->name('pengumuman.index');
    Route::post('/pengumuman', [PengumumanController::class, 'store'])->name('pengumuman.store');
    Route::delete('/pengumuman/{id}', [PengumumanController::class, 'destroy'])->name('pengumuman.destroy');
    
    Route::resource('data-teknisi', TeknisiController::class);
    Route::get('/teknisi', [PenugasanTeknisiController::class, 'index'])->name('teknisi.index');
    Route::post('/teknisi', [PenugasanTeknisiController::class, 'store'])->name('teknisi.store');
    Route::put('/teknisi/{id}/status', [PenugasanTeknisiController::class, 'updateStatus'])->name('teknisi.updateStatus');
    Route::delete('/teknisi/{id}', [PenugasanTeknisiController::class, 'destroy'])->name('teknisi.destroy');
    Route::get('/teknisi/{id}/cetak', [PenugasanTeknisiController::class, 'cetakPdf'])->name('teknisi.cetak');
    
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
});

// ==========================================
// 🟡 ZONA BERSAMA (ADMIN & BOSS)
// ==========================================
Route::middleware(['auth', 'verified', 'role:admin,boss'])->group(function () {
    Route::get('/laporan/export-pdf', [LaporanController::class, 'exportPdf'])->name('laporan.pdf');
    Route::get('/laporan/export-excel', [LaporanController::class, 'exportExcel'])->name('laporan.excel');
});

// ==========================================
// 🟠 ZONA KHUSUS BOSS
// ==========================================
Route::middleware(['auth', 'verified', 'role:boss'])->group(function () {
    Route::get('/boss/dashboard', [BossController::class, 'dashboard'])->name('boss.dashboard');
    Route::get('/boss/laporan', [App\Http\Controllers\LaporanController::class, 'index'])->name('boss.laporan.index');
    
    Route::get('/boss/staf', [ManajemenStafController::class, 'index'])->name('boss.staf.index');
    Route::post('/boss/staf', [ManajemenStafController::class, 'store'])->name('boss.staf.store');
    Route::put('/boss/staf/{id}', [ManajemenStafController::class, 'update'])->name('boss.staf.update');
    Route::delete('/boss/staf/{id}', [ManajemenStafController::class, 'destroy'])->name('boss.staf.destroy');
    
    Route::get('/boss/audit-log', [LogAktivitasController::class, 'index'])->name('boss.log.index');
    Route::delete('/boss/audit-log/clear', [LogAktivitasController::class, 'clearAll'])->name('boss.log.clear');
    Route::delete('/boss/audit-log/{id}', [LogAktivitasController::class, 'destroy'])->name('boss.log.destroy');
    
    Route::get('/boss/business-intelligence', [BusinessIntelligenceController::class, 'index'])->name('boss.bi.index');
});

// ==========================================
// 🔵 ZONA KHUSUS PELANGGAN
// ==========================================
Route::middleware(['auth', 'verified', 'role:pelanggan'])->group(function () {
    Route::get('/client/dashboard', function () {
        $profil = Pelanggan::with('paket')->where('user_id', Auth::id())->first();
        $pengumumans = App\Models\Pengumuman::where('is_aktif', true)->latest()->take(3)->get();
        $statusBulanIni = 'Belum Dibayar';
        
        if ($profil) {
            $cekPembayaran = Pembayaran::where('pelanggan_id', $profil->id)
                                        ->where('bulan_tagihan', 'LIKE', '%' . \Carbon\Carbon::now()->translatedFormat('F') . '%')
                                        ->where('bulan_tagihan', 'LIKE', '%' . \Carbon\Carbon::now()->year . '%')
                                        ->first();
            if ($cekPembayaran) {
                $statusBulanIni = strtoupper($cekPembayaran->status_pembayaran);
            }
        }
        return view('client.dashboard', compact('profil', 'pengumumans', 'statusBulanIni'));
    })->name('client.dashboard');

    Route::get('/client/tagihan', function () {
        $profil = Pelanggan::with('paket')->where('user_id', Auth::id())->first();
        $riwayat = $profil ? Pembayaran::where('pelanggan_id', $profil->id)->latest('tanggal_bayar')->get() : collect();
        $statusBulanIni = 'Belum Dibayar';
        
        if ($profil) {
            $cekPembayaran = Pembayaran::where('pelanggan_id', $profil->id)
                                        ->where('bulan_tagihan', 'LIKE', '%' . \Carbon\Carbon::now()->translatedFormat('F') . '%')
                                        ->where('bulan_tagihan', 'LIKE', '%' . \Carbon\Carbon::now()->year . '%')
                                        ->first();
            if ($cekPembayaran) {
                $statusBulanIni = strtoupper($cekPembayaran->status_pembayaran);
            }
        }
        return view('client.tagihan', compact('profil', 'riwayat', 'statusBulanIni'));
    })->name('client.tagihan');

    Route::get('/client/pembayaran', function () {
        $profil = Pelanggan::with('paket')->where('user_id', Auth::id())->first();
        $cekPembayaran = Pembayaran::where('pelanggan_id', $profil->id)
                                        ->where('bulan_tagihan', 'LIKE', '%' . \Carbon\Carbon::now()->translatedFormat('F') . '%')
                                        ->where('bulan_tagihan', 'LIKE', '%' . \Carbon\Carbon::now()->year . '%')
                                        ->first();
                                        
        if (!$profil || ($cekPembayaran && (strtoupper($cekPembayaran->status_pembayaran) === 'LUNAS' || strtoupper($cekPembayaran->status_pembayaran) === 'MENUNGGU'))) {
            return redirect()->route('client.tagihan')->with('error', 'Tagihan sudah lunas atau sedang menunggu konfirmasi.');
        }
        return view('client.pembayaran', compact('profil'));
    })->name('client.pembayaran.metode');

    Route::post('/client/bayar', function (Request $request) {
        $profil = Pelanggan::where('user_id', Auth::id())->first();
        if (!$profil) return back()->with('error', 'Profil tidak ditemukan.');

        $request->validate([
            'bulan_tagihan' => 'required|string',
            'jumlah_bayar' => 'required|numeric',
            'tanggal_bayar' => 'required|date',
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:5120', 
        ]);

        $pathBukti = null;
        if ($request->hasFile('bukti_pembayaran')) {
            $pathBukti = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');
        }

        $tagihanNunggak = Pembayaran::where('pelanggan_id', $profil->id)
            ->where('status_pembayaran', '!=', 'lunas')
            ->where('status_pembayaran', '!=', 'menunggu')
            ->first();

        if ($tagihanNunggak) {
            $tagihanNunggak->update([
                'bulan_tagihan' => $request->bulan_tagihan,
                'jumlah_bayar' => $request->jumlah_bayar,
                'tanggal_bayar' => $request->tanggal_bayar,
                'bukti_pembayaran' => $pathBukti,
                'status_pembayaran' => 'menunggu',
                'keterangan_tolak' => null
            ]);
        } else {
            $tagihanBulanIni = Pembayaran::where('pelanggan_id', $profil->id)->where('bulan_tagihan', $request->bulan_tagihan)->first();
            if ($tagihanBulanIni) {
                $tagihanBulanIni->update([
                    'jumlah_bayar' => $request->jumlah_bayar,
                    'tanggal_bayar' => $request->tanggal_bayar,
                    'bukti_pembayaran' => $pathBukti,
                    'status_pembayaran' => 'menunggu',
                    'keterangan_tolak' => null
                ]);
            } else {
                Pembayaran::create([
                    'pelanggan_id' => $profil->id,
                    'bulan_tagihan' => $request->bulan_tagihan,
                    'jumlah_bayar' => $request->jumlah_bayar,
                    'tanggal_bayar' => $request->tanggal_bayar,
                    'bukti_pembayaran' => $pathBukti,
                    'status_pembayaran' => 'menunggu',
                    'keterangan_tolak' => null
                ]);
            }
        }
        return redirect()->route('client.tagihan')->with('success', 'Bukti pembayaran berhasil dikirim! Menunggu konfirmasi Admin.');
    })->name('client.bayar');

    Route::post('/client/notifikasi/{id}/read', [\App\Http\Controllers\PembayaranController::class, 'tandaiDibaca'])->name('client.notifikasi.read');
    
    Route::get('/client/cetak-bukti/{id}', function ($id) {
        $pembayaran = Pembayaran::with('pelanggan.paket')->findOrFail($id);
        if ($pembayaran->pelanggan->user_id !== Auth::id()) abort(403, 'Akses ditolak.');
        return view('client.invoice', compact('pembayaran'));
    })->name('client.cetak');
    
    Route::get('/client/bantuan', function () {
        $profil = Pelanggan::where('user_id', Auth::id())->first();
        $tikets = $profil ? Pengaduan::where('pelanggan_id', $profil->id)->oldest('created_at')->get() : collect();
        return view('client.bantuan', compact('profil', 'tikets'));
    })->name('client.bantuan');
    
    Route::post('/client/bantuan', function (Request $request) {
        $profil = Pelanggan::where('user_id', Auth::id())->first();
        $request->validate(['jenis_gangguan' => 'required|string', 'deskripsi' => 'nullable|string']);
        Pengaduan::create([
            'pelanggan_id' => $profil->id, 'jenis_gangguan' => $request->jenis_gangguan,
            'deskripsi' => $request->deskripsi, 'status_tiket' => 'Menunggu Teknisi', 'tanggal_lapor' => now(),
        ]);
        return back()->with('success', 'Pesan berhasil dikirim!');
    })->name('client.bantuan.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';