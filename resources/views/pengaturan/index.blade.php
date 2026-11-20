<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#1a44a6] leading-tight">
            {{ __('Pengaturan Sistem ISP') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm shadow-slate-200/50">
                    <span class="font-bold">{{ session('success') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-sm shadow-slate-200/50">
                    <p class="font-bold">Gagal Menyimpan! Ada kesalahan input:</p>
                    <ul class="list-disc ml-5 text-sm mt-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white rounded-2xl shadow-sm shadow-slate-200/50 border border-slate-200 overflow-hidden">
                <div class="bg-blue-600 p-6 text-white flex items-center gap-4">
                    <div class="p-3 bg-white/20 rounded-xl backdrop-blur-sm">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-black tracking-tight">Profil Perusahaan & Aplikasi</h3>
                        <p class="text-sm text-blue-100 mt-1">Sesuaikan informasi identitas resmi ISP Anda di sini.</p>
                    </div>
                </div>

                <form action="{{ route('pengaturan.update') }}" method="POST" class="p-6 md:p-8 space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-widest mb-2">Nama Aplikasi / Brand</label>
                            <input type="text" name="nama_aplikasi" value="{{ old('nama_aplikasi', $pengaturan->nama_aplikasi) }}" class="w-full rounded-xl border-gray-300 shadow-sm shadow-slate-200/50 focus:border-blue-500 focus:ring focus:ring-blue-200 transition font-medium" placeholder="Contoh: BanyumasWiFi" required>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-widest mb-2">Nama Perusahaan (Legal)</label>
                            <input type="text" name="nama_perusahaan" value="{{ old('nama_perusahaan', $pengaturan->nama_perusahaan) }}" class="w-full rounded-xl border-gray-300 shadow-sm shadow-slate-200/50 focus:border-blue-500 focus:ring focus:ring-blue-200 transition font-medium" placeholder="Contoh: PT. Banyumas LDP" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-widest mb-2">Nomor Telepon / WhatsApp CS</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            </div>
                            <input type="text" name="no_telp" value="{{ old('no_telp', $pengaturan->no_telp) }}" class="w-full pl-11 rounded-xl border-gray-300 shadow-sm shadow-slate-200/50 focus:border-blue-500 focus:ring focus:ring-blue-200 transition font-medium" placeholder="0812xxxxxx" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-widest mb-2">Alamat Lengkap Kantor</label>
                        <textarea name="alamat" rows="3" class="w-full rounded-xl border-gray-300 shadow-sm shadow-slate-200/50 focus:border-blue-500 focus:ring focus:ring-blue-200 transition font-medium" placeholder="Masukkan alamat lengkap...">{{ old('alamat', $pengaturan->alamat) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-widest mb-2">Pesan Sambutan Pelanggan</label>
                        <textarea name="pesan_sambutan" rows="2" class="w-full rounded-xl border-gray-300 shadow-sm shadow-slate-200/50 focus:border-blue-500 focus:ring focus:ring-blue-200 transition font-medium" placeholder="Pesan singkat di dashboard pelanggan...">{{ old('pesan_sambutan', $pengaturan->pesan_sambutan) }}</textarea>
                    </div>

                    <div class="pt-6 border-t border-slate-200">
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-black py-4 rounded-xl shadow-lg transition transform hover:-translate-y-1 flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Simpan Perubahan Sistem
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
