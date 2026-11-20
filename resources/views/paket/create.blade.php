<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#1a44a6] leading-tight">
            {{ __('Tambah Paket Internet') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm shadow-slate-200/50 sm:rounded-lg">
                <div class="p-8 text-slate-800">
                    
                    <form action="{{ route('paket.store') }}" method="POST">
                        @csrf
                        <div class="mb-5">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Paket</label>
                            <input type="text" name="nama_paket" class="w-full rounded-md border-gray-300 shadow-sm shadow-slate-200/50 focus:border-blue-500 focus:ring-blue-500" placeholder="Contoh: Paket Cepat" required>
                        </div>
                        <div class="mb-5">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Kecepatan</label>
                            <input type="text" name="kecepatan" class="w-full rounded-md border-gray-300 shadow-sm shadow-slate-200/50 focus:border-blue-500 focus:ring-blue-500" placeholder="Contoh: 100 Mbps" required>
                        </div>
                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Harga (Rp)</label>
                            <!-- Menggunakan type="text" agar bisa mengetik titik -->
                            <input type="text" name="harga" class="w-full rounded-md border-gray-300 shadow-sm shadow-slate-200/50 focus:border-blue-500 focus:ring-blue-500" placeholder="Contoh: 250.000" required>
                        </div>
                        <div class="flex justify-end pt-4 border-t border-slate-200">
                            <a href="{{ route('paket.index') }}" class="text-slate-600 hover:text-slate-800 font-medium mr-6 mt-2">Batal</a>
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-md shadow-md transition">
                                Simpan Paket
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
