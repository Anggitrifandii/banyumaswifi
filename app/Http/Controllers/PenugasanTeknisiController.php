<?php

namespace App\Http\Controllers;

use App\Models\PenugasanTeknisi;
use App\Models\Teknisi;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf; // WAJIB DIPANGGIL: Mesin PDF

class PenugasanTeknisiController extends Controller
{
    public function index()
    {
        $teknisis = Teknisi::all(); 
        $tugas = PenugasanTeknisi::with('teknisi')->orderByRaw("FIELD(status, 'Menunggu', 'Sedang Dikerjakan', 'Selesai')")->orderBy('jadwal_kunjungan', 'asc')->get();
        return view('teknisi.index', compact('tugas', 'teknisis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'teknisi_id' => 'required|exists:teknisis,id',
            'judul_tugas' => 'required|string|max:255',
            'lokasi_alamat' => 'required|string',
            'jenis_tugas' => 'required|string',
            'jadwal_kunjungan' => 'required|date',
        ]);

        PenugasanTeknisi::create($request->all());

        $teknisi = Teknisi::find($request->teknisi_id);
        LogAktivitas::create(['user_id' => Auth::id(), 'modul' => 'Operasional Lapangan', 'aksi' => 'Buat Tugas Teknisi', 'keterangan' => 'Menugaskan teknisi ('.$teknisi->nama.') untuk ' . $request->jenis_tugas . ' di: ' . $request->lokasi_alamat]);

        return back()->with('success', 'Jadwal penugasan teknisi berhasil dibuat!');
    }

    public function updateStatus(Request $request, $id)
    {
        $tugas = PenugasanTeknisi::findOrFail($id);
        $tugas->status = $request->status;
        $tugas->save();

        LogAktivitas::create(['user_id' => Auth::id(), 'modul' => 'Operasional Lapangan', 'aksi' => 'Update Status Tugas', 'keterangan' => 'Mengubah status tugas "' . $tugas->judul_tugas . '" menjadi ' . strtoupper($request->status)]);
        return back()->with('success', 'Status pengerjaan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $tugas = PenugasanTeknisi::findOrFail($id);
        $judul = $tugas->judul_tugas;
        $tugas->delete();

        LogAktivitas::create(['user_id' => Auth::id(), 'modul' => 'Operasional Lapangan', 'aksi' => 'Hapus Tugas', 'keterangan' => 'Menghapus riwayat penugasan: ' . $judul]);
        return back()->with('success', 'Data tugas berhasil dihapus.');
    }

    // ==========================================
    // FUNGSI BARU: CETAK SURAT TUGAS PDF
    // ==========================================
    public function cetakPdf($id)
    {
        $tugas = PenugasanTeknisi::with('teknisi')->findOrFail($id);

        // Rekam aktivitas cetak ke Log Boss
        LogAktivitas::create([
            'user_id' => Auth::id(),
            'modul' => 'Operasional Lapangan',
            'aksi' => 'Cetak Surat Tugas',
            'keterangan' => 'Mencetak dokumen PDF Surat Tugas untuk teknisi ' . ($tugas->teknisi->nama ?? 'Unknown') . '.'
        ]);

        // Merender view PDF
        $pdf = Pdf::loadView('teknisi.surat_tugas', compact('tugas'));
        
        // Membuka PDF di tab baru (stream)
        return $pdf->stream('Surat_Tugas_'.$tugas->teknisi->nama.'_'.date('Ymd').'.pdf');
    }
}