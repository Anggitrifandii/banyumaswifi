<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Paket;
use App\Models\User;         // Untuk mengelola akun login pelanggan
use App\Models\LogAktivitas; // Untuk rekam jejak CCTV sistem
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggans = Pelanggan::with('paket')->latest()->get();
        return view('pelanggan.index', compact('pelanggans'));
    }

    public function create()
    {
        $pakets = Paket::all();
        return view('pelanggan.create', compact('pakets'));
    }

    public function store(Request $request)
    {
        // Validasi input saat pendaftaran pelanggan baru + Akun Akses
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:20',
            'paket_id' => 'required|exists:pakets,id',
            'tanggal_pasang' => 'required|date',
        ]);

        // Buat akun login user di tabel users
        $userBaru = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'pelanggan',
        ]);

        $jatuh_tempo = \Carbon\Carbon::parse($request->tanggal_pasang)->addMonth();

        // Buat data pelanggan baru (Default awal: nonaktif sampai diaktifkan admin)
        Pelanggan::create([
            'user_id' => $userBaru->id,
            'paket_id' => $request->paket_id,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'tanggal_pasang' => $request->tanggal_pasang,
            'tanggal_jatuh_tempo' => $jatuh_tempo,
            'status' => 'nonaktif', 
            'status_tagihan_bulan_ini' => 'Belum Bayar'
        ]);

        LogAktivitas::create([
            'user_id' => Auth::id(),
            'modul' => 'Master Data',
            'aksi' => 'Tambah Pelanggan',
            'keterangan' => 'Mendaftarkan pelanggan baru ' . $request->nama . ' dengan status awal Nonaktif.'
        ]);

        return redirect()->route('pelanggan.index')->with('success', 'Data Pelanggan berhasil ditambahkan dengan status awal Nonaktif.');
    }

    public function edit(Pelanggan $pelanggan)
    {
        $pakets = Paket::all();
        return view('pelanggan.edit', compact('pelanggan', 'pakets'));
    }

    // ==========================================
    // PERBAIKAN FITUR: PROSES UPDATE STATUS FIXED
    // ==========================================
    public function update(Request $request, Pelanggan $pelanggan)
    {
        // Memastikan variabel 'status' wajib divalidasi
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:20',
            'paket_id' => 'required|exists:pakets,id',
            'tanggal_pasang' => 'required|date',
            'status' => 'required|in:aktif,nonaktif', // Mengamankan input status
        ]);

        // Memasukkan variabel 'status' ke dalam query update database
        $pelanggan->update([
            'paket_id' => $request->paket_id,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'tanggal_pasang' => $request->tanggal_pasang,
            'status' => $request->status, // TERSIMPAN KE DATABASE!
        ]);

        if ($pelanggan->user_id) {
            User::where('id', $pelanggan->user_id)->update(['name' => $request->nama]);
        }

        LogAktivitas::create([
            'user_id' => Auth::id(),
            'modul' => 'Master Data',
            'aksi' => 'Update Pelanggan',
            'keterangan' => 'Mengubah data & memperbarui status akun milik ' . $request->nama . ' menjadi ' . strtoupper($request->status) . '.'
        ]);

        return redirect()->route('pelanggan.index')->with('success', 'Data Pelanggan & Status Akun berhasil diperbarui.');
    }

    public function destroy(Pelanggan $pelanggan)
    {
        $nama = $pelanggan->nama;
        $userId = $pelanggan->user_id;

        $pelanggan->delete();

        if ($userId) {
            User::where('id', $userId)->delete();
        }

        LogAktivitas::create([
            'user_id' => Auth::id(),
            'modul' => 'Master Data',
            'aksi' => 'Hapus Pelanggan',
            'keterangan' => 'Menghapus permanen data pelanggan & akun login milik: ' . $nama
        ]);

        return redirect()->route('pelanggan.index')->with('success', 'Data Pelanggan berhasil dihapus.');
    }
}