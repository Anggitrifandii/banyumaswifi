<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Pelanggan;
use App\Models\LogAktivitas; // WAJIB DIPANGGIL: Modul CCTV
use App\Models\Notifikasi;   // WAJIB DIPANGGIL: Modul Notifikasi Tagihan
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // WAJIB DIPANGGIL: Untuk tahu siapa yang sedang login

class PembayaranController extends Controller
{
    public function index()
    {
        $pembayarans = Pembayaran::with('pelanggan')->latest()->get();
        return view('pembayaran.index', compact('pembayarans'));
    }

    public function create()
    {
        $pelanggans = Pelanggan::where('status', 'aktif')->get();
        return view('pembayaran.create', compact('pelanggans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'bulan_tagihan' => 'required|string|max:255',
            'jumlah_bayar' => 'required|numeric|min:0',
            'tanggal_bayar' => 'required|date',
            'status_pembayaran' => 'required|in:lunas,belum_lunas,menunggu',
        ]);

        Pembayaran::create($request->all());

        // Mengambil nama pelanggan dari database berdasarkan ID yang dipilih admin
        $pelanggan = Pelanggan::find($request->pelanggan_id);

        // ==========================================
        // CCTV: REKAM SAAT INPUT PEMBAYARAN BARU
        // ==========================================
        LogAktivitas::create([
            'user_id' => Auth::id(),
            'modul' => 'Keuangan',
            'aksi' => 'Input Transaksi',
            'keterangan' => 'Mencatat pembayaran tagihan bulan ' . $request->bulan_tagihan . ' untuk ' . $pelanggan->nama . ' senilai Rp ' . number_format($request->jumlah_bayar, 0, ',', '.') . ' (' . strtoupper($request->status_pembayaran) . ').'
        ]);

        return redirect()->route('pembayaran.index')->with('success', 'Data Pembayaran berhasil disimpan.');
    }

    public function edit(Pembayaran $pembayaran)
    {
        $pelanggans = Pelanggan::all();
        return view('pembayaran.edit', compact('pembayaran', 'pelanggans'));
    }

    public function update(Request $request, Pembayaran $pembayaran)
    {
        $request->validate([
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'bulan_tagihan' => 'required|string|max:255',
            'jumlah_bayar' => 'required|numeric|min:0',
            'tanggal_bayar' => 'required|date',
            'status_pembayaran' => 'required|in:lunas,belum_lunas,menunggu',
        ]);

        $pembayaran->update($request->all());

        // Mengambil nama pelanggan untuk laporan CCTV
        $pelanggan = Pelanggan::find($request->pelanggan_id);

        // ==========================================
        // CCTV: REKAM SAAT UBAH DATA PEMBAYARAN
        // ==========================================
        LogAktivitas::create([
            'user_id' => Auth::id(),
            'modul' => 'Keuangan',
            'aksi' => 'Update Transaksi',
            'keterangan' => 'Mengubah data pembayaran ' . $pelanggan->nama . ' (Tagihan: ' . $request->bulan_tagihan . ') menjadi status ' . strtoupper($request->status_pembayaran) . '.'
        ]);

        return redirect()->route('pembayaran.index')->with('success', 'Data Pembayaran berhasil diperbarui.');
    }

    public function destroy(Pembayaran $pembayaran)
    {
        // Simpan data pelanggan & bulan tagihan sebelum dihapus agar bisa dilacak
        $namaPelanggan = $pembayaran->pelanggan->nama ?? 'Tidak Diketahui';
        $bulanTagihan = $pembayaran->bulan_tagihan;

        $pembayaran->delete();

        // ==========================================
        // CCTV: REKAM SAAT MENGHAPUS PEMBAYARAN
        // ==========================================
        LogAktivitas::create([
            'user_id' => Auth::id(),
            'modul' => 'Keuangan',
            'aksi' => 'Hapus Data',
            'keterangan' => 'Menghapus riwayat pembayaran milik ' . $namaPelanggan . ' untuk tagihan bulan ' . $bulanTagihan . '.'
        ]);

        return redirect()->route('pembayaran.index')->with('success', 'Riwayat pembayaran berhasil dihapus.');
    }

    // ==========================================
    // FUNGSI BARU: KIRIM TAGIHAN KE PELANGGAN
    // ==========================================
    public function kirimTagihan($id)
    {
        $pembayaran = Pembayaran::with('pelanggan')->findOrFail($id);

        // Format pesan otomatis
        $pesan = "Yth. {$pembayaran->pelanggan->nama}, Tagihan internet Anda untuk bulan {$pembayaran->bulan_tagihan} sebesar Rp" . number_format($pembayaran->jumlah_bayar, 0, ',', '.') . " telah jatuh tempo. Mohon segera melakukan pembayaran agar layanan internet tidak terisolir.";

        // Masukkan ke tabel notifikasi
        Notifikasi::create([
            'pelanggan_id' => $pembayaran->pelanggan_id,
            'judul' => '⚠️ Peringatan Tagihan Jatuh Tempo',
            'pesan' => $pesan,
            'is_read' => false
        ]);

        return redirect()->back()->with('success', 'Pesan peringatan tagihan berhasil dikirim ke dashboard pelanggan!');
    }

    // Fungsi untuk Pelanggan menandai pesan sudah dibaca
    public function tandaiDibaca($id)
    {
        $notifikasi = Notifikasi::findOrFail($id);
        $notifikasi->update(['is_read' => true]);

        return redirect()->back();
    }
    // FUNGSI BARU: ADMIN KONFIRMASI BUKTI TRANSFER
    public function konfirmasi($id)
    {
        $pembayaran = Pembayaran::with('pelanggan')->findOrFail($id);
        
        // Ubah status dari menunggu menjadi lunas
        $pembayaran->update(['status_pembayaran' => 'lunas']);

        // Rekam CCTV Log
        LogAktivitas::create([
            'user_id' => Auth::id(),
            'modul' => 'Keuangan',
            'aksi' => 'Verifikasi Pembayaran',
            'keterangan' => 'Mengkonfirmasi pembayaran tagihan (' . $pembayaran->bulan_tagihan . ') milik ' . $pembayaran->pelanggan->nama . ' menjadi LUNAS.'
        ]);

        return redirect()->back()->with('success', 'Pembayaran berhasil diverifikasi. Status pelanggan sekarang LUNAS!');
    }

    // FUNGSI BARU: ADMIN TOLAK PEMBAYARAN
    public function tolak(Request $request, $id)
    {
        $request->validate([
            'keterangan_tolak' => 'required|string|max:500'
        ]);

        $pembayaran = Pembayaran::with('pelanggan')->findOrFail($id);
        
        // Ubah status menjadi ditolak dan simpan keterangan
        $pembayaran->update([
            'status_pembayaran' => 'ditolak',
            'keterangan_tolak' => $request->keterangan_tolak
        ]);

        // Rekam CCTV Log
        LogAktivitas::create([
            'user_id' => Auth::id(),
            'modul' => 'Keuangan',
            'aksi' => 'Tolak Pembayaran',
            'keterangan' => 'Menolak pembayaran tagihan (' . $pembayaran->bulan_tagihan . ') milik ' . $pembayaran->pelanggan->nama . ' dengan alasan: ' . $request->keterangan_tolak
        ]);

        return redirect()->back()->with('success', 'Pembayaran ditolak. Alasan penolakan telah dikirim ke pelanggan.');
    }
}