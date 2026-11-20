<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#1a44a6] leading-tight">
            {{ __('Reset Akun & Akses Pelanggan') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm shadow-slate-200/50">
                    <span class="font-bold">{{ session('success') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-sm shadow-slate-200/50">
                    <p class="font-bold">Gagal Menyimpan! Periksa kembali isian Anda.</p>
                </div>
            @endif

            <div class="bg-white rounded-t-2xl border-b border-slate-200 p-6 flex items-center gap-4 shadow-sm shadow-slate-200/50">
                <div class="p-3 bg-red-50 text-red-600 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg>
                </div>
                <div>
                    <h3 class="text-lg font-black text-[#1a44a6]">Manajemen Kredensial</h3>
                    <p class="text-xs text-slate-500 font-medium">Ubah Email atau Reset Password pelanggan jika mereka lupa akses loginnya.</p>
                </div>
            </div>

            <div class="bg-white rounded-b-2xl shadow-sm shadow-slate-200/50 overflow-hidden border border-t-0 border-slate-200">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-100">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-[11px] font-black text-slate-500 uppercase tracking-widest">Nama Pelanggan</th>
                                <th class="px-6 py-4 text-left text-[11px] font-black text-slate-500 uppercase tracking-widest">Email Login Saat Ini</th>
                                <th class="px-6 py-4 text-center text-[11px] font-black text-slate-500 uppercase tracking-widest">Status Berlangganan</th>
                                <th class="px-6 py-4 text-right text-[11px] font-black text-slate-500 uppercase tracking-widest">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($pelanggans as $p)
                                <tr class="hover:bg-red-50/20 transition" x-data="{ openEdit: false }">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="font-bold text-slate-800 text-sm">{{ $p->nama }}</div>
                                        <div class="text-xs text-slate-500">{{ $p->no_hp }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-bold text-blue-600">{{ $p->user->email ?? 'Tidak ada akun' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider {{ strtolower($p->status) == 'aktif' ? 'bg-green-100 text-green-700' : 'bg-slate-100 text-slate-600' }}">
                                            {{ $p->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right">
                                        <button @click="openEdit = true" class="bg-red-50 text-red-600 hover:bg-red-600 hover:text-white font-bold py-1.5 px-4 rounded shadow-sm shadow-slate-200/50 text-xs transition">
                                            Ubah Email / Password
                                        </button>

                                        <div x-show="openEdit" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-gray-900/60 backdrop-blur-sm" style="display: none;" x-transition>
                                            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden text-left" @click.away="openEdit = false">
                                                <div class="bg-red-600 p-4 flex justify-between items-center text-white">
                                                    <h3 class="font-bold">Reset Kredensial: {{ $p->nama }}</h3>
                                                    <button @click="openEdit = false" class="hover:text-red-200 text-xl leading-none">&times;</button>
                                                </div>
                                                <form action="{{ route('akun.update', $p->user->id) }}" method="POST" class="p-6 space-y-4">
                                                    @csrf @method('PUT')
                                                    <div>
                                                        <label class="block text-xs font-bold text-gray-700 mb-1">Email Login Baru</label>
                                                        <input type="email" name="email" value="{{ $p->user->email }}" class="w-full rounded-lg border-gray-300" required>
                                                    </div>
                                                    <div>
                                                        <label class="block text-xs font-bold text-gray-700 mb-1">Password Baru</label>
                                                        <input type="password" name="password" class="w-full rounded-lg border-gray-300 placeholder-gray-400" placeholder="Biarkan kosong jika tidak diubah">
                                                        <p class="text-[10px] text-slate-500 mt-1 italic">*Minimal 8 karakter. Isi hanya jika ingin me-reset password.</p>
                                                    </div>
                                                    <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-black py-3 rounded-xl shadow-lg transition">Simpan Akses Baru</button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="px-6 py-12 text-center text-slate-500 font-medium">Belum ada pelanggan terdaftar.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
