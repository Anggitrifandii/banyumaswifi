<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Pelanggan;
use App\Models\Paket;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Menampilkan form pendaftaran beserta pilihan paket.
     */
    public function create(Request $request): View
    {
        $pakets = Paket::all();
        // Menangkap ID Paket dari URL jika calon pelanggan klik dari halaman depan
        $selectedPaket = $request->query('paket_id');
        
        return view('auth.register', compact('pakets', 'selectedPaket'));
    }

    /**
     * Memproses pendaftaran User dan OTOMATIS membuat data Pelanggan.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            // Validasi tambahan: Tanggal pasang wajib ada dan tidak boleh tanggal kemarin
            'no_hp' => ['required', 'string', 'max:20'],
            'alamat' => ['required', 'string'],
            'paket_id' => ['required', 'exists:pakets,id'],
            'tanggal_pasang' => ['required', 'date', 'after_or_equal:today'],
        ]);

        // 1. Buat Akun Login (User)
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'pelanggan', 
        ]);

        // 2. OTOMATIS: Buat Data Pelanggan yang tersambung dengan Akun & Paket!
        Pelanggan::create([
            'user_id' => $user->id,
            'paket_id' => $request->paket_id,
            'nama' => $request->name,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            // LOGIKA BARU: Mengambil tanggal sesuai pilihan pelanggan dari form
            'tanggal_pasang' => $request->tanggal_pasang, 
            'status' => 'nonaktif', // OTOMATIS NONAKTIF (Menunggu Admin)
        ]);

        event(new Registered($user));

        Auth::login($user);

        // Langsung arahkan ke Dashboard Client
        return redirect(RouteServiceProvider::HOME);
    }
}