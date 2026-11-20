<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-[#1a44a6] leading-tight">
                {{ __('Tambah Data Pelanggan Baru') }}
            </h2>
            <div class="text-xs text-slate-400 font-bold uppercase tracking-widest hidden sm:block">
                Home / Dashboard
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Tampilkan pesan error jika email sudah terdaftar atau input tidak valid -->
            @if ($errors->any())
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-xl shadow-sm">
                    <ul class="list-disc pl-5 text-sm font-medium">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm shadow-slate-200/50 sm:rounded-3xl border border-slate-200 p-8 sm:p-12">
                <form action="{{ route('pelanggan.store') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap Pelanggan <span class="text-red-500">*</span></label>
                        <input type="text" name="nama" class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 shadow-sm" placeholder="Masukkan nama pelanggan" value="{{ old('nama') }}" required>
                    </div>

                    <!-- KOLOM TAMBAHAN: PENGATURAN AKUN LOGIN (EMAIL & PASSWORD) -->
                    <div class="bg-blue-50/50 p-6 rounded-xl border border-blue-100 space-y-4">
                        <div class="flex items-center gap-2 mb-2 border-b border-blue-200 pb-2">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            <h4 class="text-sm font-black text-blue-900 uppercase tracking-widest">Informasi Login Pelanggan</h4>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-bold text-blue-900 mb-2">Email <span class="text-red-500">*</span></label>
                                <input type="email" name="email" class="w-full rounded-xl border-blue-200 focus:border-blue-500 focus:ring focus:ring-blue-200 shadow-sm" placeholder="pelanggan@gmail.com" value="{{ old('email') }}" required>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-blue-900 mb-2">Password <span class="text-red-500">*</span></label>
                                <!-- Menggunakan type="text" agar admin bisa melihat password yang dibuatkan untuk pelanggan -->
                                <input type="text" name="password" class="w-full rounded-xl border-blue-200 focus:border-blue-500 focus:ring focus:ring-blue-200 shadow-sm" placeholder="Minimal 6 karakter" required>
                            </div>
                        </div>
                        <p class="text-[10px] font-bold text-slate-500 flex items-center gap-1">
                            <svg class="w-3 h-3 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Informasikan Email dan Password di atas kepada pelanggan agar mereka bisa mengakses Client Area.
                        </p>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Alamat Pemasangan <span class="text-red-500">*</span></label>
                        <textarea name="alamat" rows="3" class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 shadow-sm" placeholder="Masukkan alamat lengkap (RT/RW/Desa)" required>{{ old('alamat') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Nomor WhatsApp / HP <span class="text-red-500">*</span></label>
                        <input type="text" name="no_hp" class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 shadow-sm" placeholder="Contoh: 081234567890" value="{{ old('no_hp') }}" required>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Pilih Paket Internet <span class="text-red-500">*</span></label>
                        <select name="paket_id" class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 shadow-sm" required>
                            <option value="">-- Silakan Pilih Paket --</option>
                            @foreach($pakets as $paket)
                                <option value="{{ $paket->id }}" {{ old('paket_id') == $paket->id ? 'selected' : '' }}>{{ $paket->nama_paket }} - Rp {{ number_format($paket->harga, 0, ',', '.') }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Tanggal Pemasangan <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_pasang" class="w-full sm:w-1/2 rounded-xl border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 shadow-sm" value="{{ old('tanggal_pasang') }}" required>
                    </div>

                    <div class="pt-6 border-t border-slate-100 flex flex-col sm:flex-row justify-end gap-3">
                        <a href="{{ route('pelanggan.index') }}" class="w-full sm:w-auto px-8 py-3 bg-slate-100 hover:bg-slate-200 text-slate-700 text-center font-extrabold rounded-xl transition-colors">Batal</a>
                        <button type="submit" class="w-full sm:w-auto px-8 py-3 bg-[#1a44a6] hover:bg-blue-800 text-white font-extrabold rounded-xl shadow-lg shadow-blue-500/30 transition-all transform hover:-translate-y-0.5">Simpan Data & Buat Akun</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>