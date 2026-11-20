<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    public function index()
    {
        $pengumumans = Pengumuman::latest()->get();
        return view('pengumuman.index', compact('pengumumans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi_pengumuman' => 'required|string',
            'tipe' => 'required|in:info,warning,promo',
        ]);

        $validated['is_aktif'] = true;
        Pengumuman::create($validated);

        return back()->with('success', 'Pengumuman berhasil disiarkan ke pelanggan!');
    }

    public function destroy($id)
    {
        Pengumuman::findOrFail($id)->delete();
        return back()->with('success', 'Pengumuman berhasil ditarik/dihapus.');
    }
}