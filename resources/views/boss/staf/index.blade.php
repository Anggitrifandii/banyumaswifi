<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#1a44a6] leading-tight">
            {{ __('Manajemen Staf & Hak Akses') }}
        </h2>
    </x-slot>

    <div class="py-8" x-data="{ openAdd: false }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 p-4 mb-6 rounded shadow-sm shadow-slate-200/50 flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    <span class="font-bold">{{ session('success') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-sm shadow-slate-200/50">
                    <p class="font-bold">Gagal Menyimpan! Periksa inputan Anda:</p>
                    <ul class="list-disc ml-5 text-sm mt-1">
                        @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-slate-800 rounded-t-2xl border-b border-slate-700 p-6 flex flex-col sm:flex-row justify-between items-center gap-4 shadow-lg text-white relative overflow-hidden">
                <svg class="absolute right-0 top-0 opacity-5 w-48 h-48 transform translate-x-10 -translate-y-10" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                
                <div class="flex items-center gap-4 relative z-10">
                    <div class="p-3 bg-white/10 text-yellow-400 rounded-xl backdrop-blur-sm border border-white/10">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-black tracking-wide text-white">Akun Karyawan & Admin</h3>
                        <p class="text-xs text-slate-300 font-medium mt-0.5">Kontrol penuh siapa yang memiliki akses ke panel operasional ISP.</p>
                    </div>
                </div>
                <button @click="openAdd = true" class="relative z-10 bg-yellow-400 hover:bg-yellow-500 text-slate-900 font-black py-2.5 px-6 rounded-xl shadow-lg transition flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                    Tambah Staf Baru
                </button>
            </div>

            <div class="bg-white rounded-b-2xl shadow-sm shadow-slate-200/50 overflow-hidden border border-t-0 border-slate-200">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-100">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-[11px] font-black text-slate-500 uppercase tracking-widest">Identitas Admin</th>
                                <th class="px-6 py-4 text-left text-[11px] font-black text-slate-500 uppercase tracking-widest">Email Akses</th>
                                <th class="px-6 py-4 text-center text-[11px] font-black text-slate-500 uppercase tracking-widest">Tanggal Bergabung</th>
                                <th class="px-6 py-4 text-right text-[11px] font-black text-slate-500 uppercase tracking-widest">Aksi Hak Prerogatif</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($stafs as $staf)
                                <tr class="hover:bg-slate-50/50 transition" x-data="{ openEdit: false }">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-black text-xs">
                                                {{ strtoupper(substr($staf->name, 0, 1)) }}
                                            </div>
                                            <div class="font-bold text-slate-800">{{ $staf->name }}</div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600 font-medium">
                                        {{ $staf->email }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-slate-500">
                                        {{ $staf->created_at->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right">
                                        <div class="flex justify-end gap-2">
                                            <button @click="openEdit = true" class="bg-slate-100 text-slate-600 hover:bg-slate-800 hover:text-white font-bold py-1.5 px-3 rounded shadow-sm shadow-slate-200/50 text-xs transition">Edit Akses</button>
                                            
                                            <form action="{{ route('boss.staf.destroy', $staf->id) }}" method="POST" onsubmit="return confirm('Peringatan Eksekutif: Yakin ingin mencabut akses dan menghapus akun staf ini secara permanen?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="bg-red-50 text-red-600 hover:bg-red-600 hover:text-white font-bold py-1.5 px-3 rounded shadow-sm shadow-slate-200/50 text-xs transition">Cabut Akses</button>
                                            </form>
                                        </div>

                                        <div x-show="openEdit" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm" style="display: none;" x-transition>
                                            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden text-left" @click.away="openEdit = false">
                                                <div class="bg-slate-800 p-4 flex justify-between items-center text-white border-b border-yellow-400">
                                                    <h3 class="font-bold">Edit Akun: {{ $staf->name }}</h3>
                                                    <button @click="openEdit = false" class="hover:text-yellow-400 text-xl leading-none">&times;</button>
                                                </div>
                                                <form action="{{ route('boss.staf.update', $staf->id) }}" method="POST" class="p-6 space-y-4">
                                                    @csrf @method('PUT')
                                                    <div>
                                                        <label class="block text-xs font-bold text-gray-700 mb-1">Nama Lengkap</label>
                                                        <input type="text" name="name" value="{{ $staf->name }}" class="w-full rounded-lg border-gray-300" required>
                                                    </div>
                                                    <div>
                                                        <label class="block text-xs font-bold text-gray-700 mb-1">Email (Untuk Login)</label>
                                                        <input type="email" name="email" value="{{ $staf->email }}" class="w-full rounded-lg border-gray-300" required>
                                                    </div>
                                                    <div>
                                                        <label class="block text-xs font-bold text-gray-700 mb-1">Password Baru</label>
                                                        <input type="password" name="password" class="w-full rounded-lg border-gray-300 placeholder-gray-400" placeholder="Kosongkan jika tidak ingin diubah">
                                                        <p class="text-[10px] text-slate-500 mt-1 italic">*Hanya isi jika Staf lupa password.</p>
                                                    </div>
                                                    <button type="submit" class="w-full bg-yellow-400 hover:bg-yellow-500 text-slate-900 font-black py-3 rounded-xl shadow-lg transition">Simpan Perubahan</button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="px-6 py-12 text-center text-slate-500 font-medium">Belum ada akun staf/admin yang terdaftar.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div x-show="openAdd" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm" style="display: none;" x-transition>
                <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden" @click.away="openAdd = false">
                    <div class="bg-slate-800 p-4 text-white flex justify-between items-center font-bold border-b-2 border-yellow-400">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            <span>Buat Akun Staf Baru</span>
                        </div>
                        <button @click="openAdd = false" class="hover:text-yellow-400 text-2xl leading-none">&times;</button>
                    </div>
                    <form action="{{ route('boss.staf.store') }}" method="POST" class="p-6 space-y-4">
                        @csrf
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">Nama Lengkap Karyawan</label>
                            <input type="text" name="name" class="w-full rounded-lg border-gray-300" placeholder="Misal: Budi Santoso" required>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">Email Resmi (Akses Login)</label>
                            <input type="email" name="email" class="w-full rounded-lg border-gray-300" placeholder="budi@banyumaswifi.com" required>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">Set Password Awal</label>
                            <input type="password" name="password" class="w-full rounded-lg border-gray-300" required>
                            <p class="text-[10px] text-slate-500 mt-1">*Minimal 8 karakter. Staf dapat mengubahnya nanti.</p>
                        </div>
                        
                        <div class="bg-yellow-50 p-3 rounded-lg border border-yellow-200 mt-4">
                            <p class="text-[10px] text-yellow-800 font-bold leading-tight">Hak Akses: Akun ini akan secara otomatis diberikan wewenang penuh pada panel "Dashboard Admin" (Operasional).</p>
                        </div>

                        <button type="submit" class="w-full bg-slate-800 hover:bg-slate-900 text-white font-black py-3 rounded-xl shadow-lg transition mt-2">Daftarkan Staf & Berikan Akses</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
