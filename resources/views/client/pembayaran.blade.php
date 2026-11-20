<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#1a44a6] leading-tight">
            {{ __('Formulir Pembayaran Tagihan') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <form action="{{ route('client.bayar') }}" method="POST" enctype="multipart/form-data" class="bg-white p-8 rounded-3xl shadow-sm border border-slate-200">
                @csrf
                <div class="mb-8 border-b border-slate-100 pb-6 text-center">
                    <h3 class="text-2xl font-black text-slate-800">Total Tagihan: Rp {{ number_format($profil->paket->harga ?? 0, 0, ',', '.') }}</h3>
                    <p class="text-sm text-slate-500 mt-2">Silakan transfer sesuai nominal di atas ke salah satu rekening kami.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Bulan Tagihan</label>
                        <input type="text" name="bulan_tagihan" class="w-full rounded-xl border-gray-300 bg-gray-100 font-bold" value="{{ \Carbon\Carbon::now()->translatedFormat('F Y') }}" readonly>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Tanggal Transfer</label>
                        <input type="date" name="tanggal_bayar" class="w-full rounded-xl border-gray-300 focus:border-blue-500" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" required>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Jumlah Transfer (Rp)</label>
                        <input type="number" name="jumlah_bayar" class="w-full rounded-xl border-gray-300 focus:border-blue-500 font-bold text-lg" value="{{ $profil->paket->harga ?? 0 }}" required>
                    </div>
                </div>

                <div class="mb-8">
                    <label class="block text-sm font-black text-slate-700 mb-4 uppercase tracking-wider">Rekening Tujuan Pembayaran</label>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="border border-blue-200 bg-blue-50 rounded-xl p-4">
                            <p class="font-bold text-blue-900">BCA - 1234567890</p>
                            <p class="text-xs text-blue-700">A/N: PT BanyumasWiFi</p>
                        </div>
                        <div class="border border-blue-200 bg-blue-50 rounded-xl p-4">
                            <p class="font-bold text-blue-900">BRI - 0987654321</p>
                            <p class="text-xs text-blue-700">A/N: PT BanyumasWiFi</p>
                        </div>
                    </div>
                </div>

                <div class="mb-8 bg-amber-50 border border-amber-200 p-6 rounded-2xl">
                    <label class="block text-sm font-black text-amber-900 mb-2">Upload Bukti Transfer <span class="text-red-500">*</span></label>
                    <p class="text-xs text-amber-700 mb-4">Pastikan foto struk atau screenshot bukti transfer terlihat jelas.</p>
                    <input type="file" name="bukti_pembayaran" accept="image/*" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-amber-100 file:text-amber-700 hover:file:bg-amber-200" required>
                </div>

                <button type="submit" class="w-full bg-[#1a44a6] hover:bg-blue-800 text-white font-extrabold text-lg py-4 rounded-xl shadow-lg transition-transform transform hover:-translate-y-1">
                    Kirim Bukti Pembayaran 📤
                </button>
            </form>

        </div>
    </div>
</x-app-layout>