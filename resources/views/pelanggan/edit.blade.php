<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-[#1a44a6] leading-tight">
                {{ __('Ubah Data & Manajemen Status Pelanggan') }}
            </h2>
            <div class="text-xs text-slate-400 font-bold uppercase tracking-widest hidden sm:block">
                Admin Panel / Edit
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
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
                <form action="{{ route('pelanggan.update', $pelanggan->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap Pelanggan <span class="text-red-500">*</span></label>
                        <input type="text" name="nama" class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 shadow-sm font-semibold text-slate-700" value="{{ old('nama', $pelanggan->nama) }}" required>
                    </div>

                    <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200">
                        <label class="block text-sm font-black text-slate-700 mb-2.5 uppercase tracking-wider text-xs">Aktivasi & Status Layanan Internet</label>
                        <select name="status" class="w-full sm:w-1/2 rounded-xl border-gray-300 font-bold focus:ring focus:ring-blue-200 shadow-sm 
                            {{ old('status', $pelanggan->status) == 'aktif' ? 'text-emerald-600 border-emerald-300 bg-emerald-50/30' : 'text-rose-600 border-rose-300 bg-rose-50/30' }}" required>
                            <option value="aktif" {{ old('status', $pelanggan->status) == 'aktif' ? 'selected' : '' }}>🟢 AKTIF & BERJALAN</option>
                            <option value="nonaktif" {{ old('status', $pelanggan->status) == 'nonaktif' ? 'selected' : '' }}>🔴 NONAKTIF / ISOLIR</option>
                        </select>
                        <p class="text-[10px] text-slate-400 font-medium mt-2">*Mengubah status menjadi Aktif akan langsung membuka akses halaman dashboard bagi pelanggan tersebut.</p>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Alamat Pemasangan <span class="text-red-500">*</span></label>
                        <textarea name="alamat" rows="3" class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 shadow-sm" required>{{ old('alamat', $pelanggan->alamat) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Nomor WhatsApp / HP <span class="text-red-500">*</span></label>
                        <input type="text" name="no_hp" class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 shadow-sm font-mono" value="{{ old('no_hp', $pelanggan->no_hp) }}" required>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Paket Internet Langganan <span class="text-red-500">*</span></label>
                        <select name="paket_id" class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 shadow-sm font-semibold text-slate-700" required>
                            @foreach($pakets as $paket)
                                <option value="{{ $paket->id }}" {{ old('paket_id', $pelanggan->paket_id) == $paket->id ? 'selected' : '' }}>
                                    {{ $paket->nama_paket }} - Rp {{ number_format($paket->harga, 0, ',', '.') }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Tanggal Registrasi Pemasangan <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_pasang" class="w-full sm:w-1/2 rounded-xl border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 shadow-sm" value="{{ old('tanggal_pasang', $pelanggan->tanggal_pasang) }}" required>
                    </div>

                    <div class="pt-6 border-t border-slate-100 flex flex-col sm:flex-row justify-end gap-3">
                        <a href="{{ route('pelanggan.index') }}" class="w-full sm:w-auto px-8 py-3 bg-slate-100 hover:bg-slate-200 text-slate-700 text-center font-extrabold rounded-xl transition-colors">Batal</a>
                        <button type="submit" class="w-full sm:w-auto px-8 py-3 bg-[#1a44a6] hover:bg-blue-800 text-white font-extrabold rounded-xl shadow-lg shadow-blue-500/30 transition-all transform hover:-translate-y-0.5">Simpan Perubahan</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>