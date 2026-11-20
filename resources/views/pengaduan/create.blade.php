<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#1a44a6] leading-tight">
            {{ __('Buat Tiket Gangguan Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm shadow-slate-200/50 sm:rounded-lg">
                <div class="p-8 text-slate-800">
                    
                    <form action="{{ route('pengaduan.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-5">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Pelanggan yang Melapor <span class="text-red-500">*</span></label>
                            <select name="pelanggan_id" class="w-full rounded-md border-gray-300 shadow-sm shadow-slate-200/50 focus:border-red-500 focus:ring-red-500" required>
                                <option value="" disabled selected>-- Cari Nama Pelanggan --</option>
                                @foreach($pelanggans as $pelanggan)
                                    <option value="{{ $pelanggan->id }}">
                                        {{ $pelanggan->nama }} ({{ $pelanggan->no_hp }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-5">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Jenis Gangguan <span class="text-red-500">*</span></label>
                            <select name="jenis_gangguan" class="w-full rounded-md border-gray-300 shadow-sm shadow-slate-200/50 focus:border-red-500 focus:ring-red-500" required>
                                <option value="" disabled selected>-- Pilih Jenis --</option>
                                <option value="Internet Mati / LOS Merah">Internet Mati / LOS Merah</option>
                                <option value="Koneksi Lambat">Koneksi Lambat</option>
                                <option value="Kabel Putus / Tiang Roboh">Kabel Putus / Tiang Roboh</option>
                                <option value="Ganti Password WiFi">Ganti Password WiFi</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>

                        <div class="mb-5">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Detail Tambahan (Opsional)</label>
                            <textarea name="deskripsi" rows="3" class="w-full rounded-md border-gray-300 shadow-sm shadow-slate-200/50 focus:border-red-500 focus:ring-red-500" placeholder="Contoh: Kabel ketarik truk tangki..."></textarea>
                        </div>

                        <div class="mb-5">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Tanggal Lapor <span class="text-red-500">*</span></label>
                            <input type="date" name="tanggal_lapor" class="w-full rounded-md border-gray-300 shadow-sm shadow-slate-200/50 focus:border-red-500 focus:ring-red-500" value="{{ date('Y-m-d') }}" required>
                        </div>

                        <div class="flex justify-end pt-4 border-t border-slate-200 mt-6">
                            <a href="{{ route('pengaduan.index') }}" class="text-slate-600 hover:text-slate-800 font-medium mr-6 mt-2">Batal</a>
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-6 rounded-md shadow-md">
                                Simpan Tiket
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
