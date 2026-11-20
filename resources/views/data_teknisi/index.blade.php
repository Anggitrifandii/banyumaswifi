<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#1a44a6] leading-tight">Master Data Teknisi</h2>
    </x-slot>

    <div class="py-8" x-data="{ openAdd: false }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm shadow-slate-200/50">
                    <span class="font-bold">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white rounded-t-2xl border-b border-slate-200 p-6 flex justify-between items-center shadow-sm shadow-slate-200/50">
                <div class="flex items-center gap-3">
                    <div class="p-3 bg-blue-50 text-blue-600 rounded-xl">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-black text-[#1a44a6]">Personel Teknisi</h3>
                        <p class="text-xs text-slate-500 font-medium">Kelola data teknisi lapangan yang akan menerima penugasan.</p>
                    </div>
                </div>
                <button @click="openAdd = true" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-6 rounded-xl shadow-sm shadow-slate-200/50 transition">
                    + Tambah Teknisi
                </button>
            </div>

            <div class="bg-white rounded-b-2xl shadow-sm shadow-slate-200/50 overflow-hidden border border-t-0 border-slate-200">
                <table class="min-w-full divide-y divide-slate-100">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-[11px] font-black text-slate-500 uppercase">Nama Teknisi</th>
                            <th class="px-6 py-4 text-left text-[11px] font-black text-slate-500 uppercase">No Telepon</th>
                            <th class="px-6 py-4 text-left text-[11px] font-black text-slate-500 uppercase">Email</th>
                            <th class="px-6 py-4 text-right text-[11px] font-black text-slate-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($teknisis as $tek)
                            <tr class="hover:bg-slate-50" x-data="{ openEdit: false }">
                                <td class="px-6 py-4 font-bold text-slate-800">{{ $tek->nama }}</td>
                                <td class="px-6 py-4 text-sm text-slate-600">{{ $tek->no_telp }}</td>
                                <td class="px-6 py-4 text-sm text-slate-600">{{ $tek->email }}</td>
                                <td class="px-6 py-4 text-right flex justify-end gap-2">
                                    <button @click="openEdit = true" class="bg-blue-50 text-blue-600 px-3 py-1.5 rounded font-bold text-xs">Edit</button>
                                    <form action="{{ route('data-teknisi.destroy', $tek->id) }}" method="POST" onsubmit="return confirm('Hapus teknisi ini?')">
                                        @csrf @method('DELETE')
                                        <button class="bg-red-50 text-red-600 px-3 py-1.5 rounded font-bold text-xs">Hapus</button>
                                    </form>

                                    <div x-show="openEdit" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-gray-900/60 backdrop-blur-sm" style="display: none;">
                                        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm shadow-xl w-full max-w-md text-left" @click.away="openEdit = false">
                                            <div class="p-4 bg-slate-50 border-b font-bold flex justify-between">Edit Teknisi <button @click="openEdit = false">&times;</button></div>
                                            <form action="{{ route('data-teknisi.update', $tek->id) }}" method="POST" class="p-6 space-y-4">
                                                @csrf @method('PUT')
                                                <div><label class="block text-xs font-bold mb-1">Nama</label><input type="text" name="nama" value="{{ $tek->nama }}" class="w-full rounded-lg border-gray-300" required></div>
                                                <div><label class="block text-xs font-bold mb-1">No Telp</label><input type="text" name="no_telp" value="{{ $tek->no_telp }}" class="w-full rounded-lg border-gray-300" required></div>
                                                <div><label class="block text-xs font-bold mb-1">Email</label><input type="email" name="email" value="{{ $tek->email }}" class="w-full rounded-lg border-gray-300" required></div>
                                                <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 rounded-lg">Simpan</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div x-show="openAdd" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-gray-900/60 backdrop-blur-sm" style="display: none;">
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm shadow-xl w-full max-w-md text-left" @click.away="openAdd = false">
                    <div class="p-4 bg-blue-600 text-white font-bold flex justify-between">Tambah Teknisi Baru <button @click="openAdd = false">&times;</button></div>
                    <form action="{{ route('data-teknisi.store') }}" method="POST" class="p-6 space-y-4">
                        @csrf
                        <div><label class="block text-xs font-bold mb-1">Nama Lengkap</label><input type="text" name="nama" class="w-full rounded-lg border-gray-300" required></div>
                        <div><label class="block text-xs font-bold mb-1">Nomor WhatsApp / Telp</label><input type="text" name="no_telp" class="w-full rounded-lg border-gray-300" required></div>
                        <div><label class="block text-xs font-bold mb-1">Alamat Email</label><input type="email" name="email" class="w-full rounded-lg border-gray-300" required></div>
                        <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 rounded-lg mt-2">Daftarkan Teknisi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
