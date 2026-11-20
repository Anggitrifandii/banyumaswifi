<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#1a44a6] leading-tight">
            {{ __('Input Pembayaran Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm shadow-slate-200/50 sm:rounded-lg">
                <div class="p-8 text-slate-800">
                    
                    <form action="{{ route('pembayaran.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-5">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Pilih Pelanggan <span class="text-red-500">*</span></label>
                            <select name="pelanggan_id" class="w-full rounded-md border-gray-300 shadow-sm shadow-slate-200/50" required>
                                <option value="" disabled selected>-- Pilih Pelanggan --</option>
                                @foreach($pelanggans as $pelanggan)
                                    <option value="{{ $pelanggan->id }}">
                                        {{ $pelanggan->nama }} - {{ $pelanggan->paket->nama_paket ?? '' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-5">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Bulan Tagihan <span class="text-red-500">*</span></label>
                            <input type="text" name="bulan_tagihan" class="w-full rounded-md border-gray-300 shadow-sm shadow-slate-200/50" placeholder="Contoh: Januari 2024" required>
                        </div>

                        <div class="mb-5">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Jumlah Bayar (Rp) <span class="text-red-500">*</span></label>
                            <input type="number" name="jumlah_bayar" class="w-full rounded-md border-gray-300 shadow-sm shadow-slate-200/50" placeholder="Contoh: 150000" required>
                        </div>

                        <div class="mb-5">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Tanggal Bayar <span class="text-red-500">*</span></label>
                            <input type="date" name="tanggal_bayar" class="w-full rounded-md border-gray-300 shadow-sm shadow-slate-200/50" value="{{ date('Y-m-d') }}" required>
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Status Pembayaran <span class="text-red-500">*</span></label>
                            <select name="status_pembayaran" class="w-full rounded-md border-gray-300 shadow-sm shadow-slate-200/50" required>
                                <option value="lunas">Lunas</option>
                                <option value="belum_lunas">Belum Lunas / Sebagian</option>
                            </select>
                        </div>

                        <div class="flex justify-end pt-4 border-t border-slate-200 mt-6">
                            <a href="{{ route('pembayaran.index') }}" class="text-slate-600 hover:text-slate-800 font-medium mr-6 mt-2">Batal</a>
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-md shadow-md">
                                Simpan Pembayaran
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
