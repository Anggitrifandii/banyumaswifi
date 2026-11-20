<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#1a44a6] leading-tight">
            {{ __('Edit Transaksi Pembayaran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm shadow-slate-200/50 sm:rounded-lg">
                <div class="p-8 text-slate-800">
                    <form action="{{ route('pembayaran.update', $pembayaran->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-5">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Pelanggan</label>
                            <select name="pelanggan_id" class="w-full rounded-md border-gray-300 shadow-sm shadow-slate-200/50 bg-slate-50" required>
                                @foreach($pelanggans as $pelanggan)
                                    <option value="{{ $pelanggan->id }}" {{ $pembayaran->pelanggan_id == $pelanggan->id ? 'selected' : '' }}>
                                        {{ $pelanggan->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-5">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Bulan Tagihan</label>
                            <input type="text" name="bulan_tagihan" class="w-full rounded-md border-gray-300 shadow-sm shadow-slate-200/50" value="{{ $pembayaran->bulan_tagihan }}" required>
                        </div>

                        <div class="mb-5">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Jumlah Bayar (Rp)</label>
                            <input type="number" name="jumlah_bayar" class="w-full rounded-md border-gray-300 shadow-sm shadow-slate-200/50" value="{{ $pembayaran->jumlah_bayar }}" required>
                        </div>

                        <div class="mb-5">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Tanggal Bayar</label>
                            <input type="date" name="tanggal_bayar" class="w-full rounded-md border-gray-300 shadow-sm shadow-slate-200/50" value="{{ $pembayaran->tanggal_bayar }}" required>
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Status Pembayaran</label>
                            <select name="status_pembayaran" class="w-full rounded-md border-gray-300 shadow-sm shadow-slate-200/50" required>
                                <option value="lunas" {{ $pembayaran->status_pembayaran == 'lunas' ? 'selected' : '' }}>Lunas</option>
                                <option value="belum_lunas" {{ $pembayaran->status_pembayaran == 'belum_lunas' ? 'selected' : '' }}>Belum Lunas / Sebagian</option>
                            </select>
                        </div>

                        <div class="flex justify-end pt-4 border-t border-slate-200">
                            <a href="{{ route('pembayaran.index') }}" class="text-slate-600 hover:text-slate-800 font-medium mr-6 mt-2">Batal</a>
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-md shadow-md">
                                Update Pembayaran
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
