<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#1a44a6] leading-tight">
            {{ __('Audit Trail & Log Aktivitas') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 p-4 mb-6 rounded shadow-sm shadow-slate-200/50 flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    <span class="font-bold">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-slate-800 rounded-2xl shadow-lg p-6 text-white mb-8 flex flex-col md:flex-row justify-between items-center gap-4 relative overflow-hidden">
                <svg class="absolute right-0 bottom-0 opacity-5 w-64 h-64 transform translate-x-10 translate-y-10" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path></svg>
                
                <div class="flex items-center gap-4 relative z-10">
                    <div class="p-4 bg-slate-700/50 rounded-2xl border border-slate-600 shadow-inner text-yellow-400">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-2xl font-black tracking-tight text-white">System Audit Trail</h3>
                        <p class="text-sm text-slate-300 mt-1">Pantau secara *real-time* seluruh rekam jejak aktivitas staf pada sistem.</p>
                    </div>
                </div>

                <div class="relative z-10 flex flex-col items-end gap-3">
                    <div class="bg-slate-900/50 px-4 py-2 rounded-lg border border-slate-700 text-center w-full">
                        <p class="text-[10px] uppercase tracking-widest text-slate-400 font-bold mb-0.5">Status Perekaman</p>
                        <div class="flex items-center justify-center gap-2 text-emerald-400 font-bold text-sm">
                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-pulse"></span>
                            LIVE AKTIF
                        </div>
                    </div>
                    
                    @if($logs->count() > 0)
                    <form action="{{ route('boss.log.clear') }}" method="POST" onsubmit="return confirm('Peringatan Eksekutif: Anda yakin ingin MENGHAPUS SELURUH riwayat log aktivitas? Tindakan ini tidak bisa dibatalkan.')">
                        @csrf @method('DELETE')
                        <button type="submit" class="bg-red-500/20 hover:bg-red-500 text-red-200 hover:text-white border border-red-500/50 hover:border-red-500 text-xs font-bold py-1.5 px-3 rounded-lg transition duration-300 flex items-center gap-1 shadow-sm shadow-slate-200/50">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            Bersihkan Semua Log
                        </button>
                    </form>
                    @endif
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm shadow-slate-200/50 border border-slate-200 p-8">
                <div class="relative border-l-2 border-slate-100 ml-4 space-y-10">
                    
                    @forelse($logs as $log)
                        <div class="relative pl-8 sm:pl-10 group">
                            <div class="absolute -left-[17px] top-1 w-8 h-8 rounded-full border-4 border-white flex items-center justify-center shadow-sm shadow-slate-200/50
                                {{ $log->modul == 'Keuangan' || $log->modul == 'Pembayaran' ? 'bg-emerald-500' : 
                                  ($log->modul == 'Voucher' ? 'bg-orange-500' : 
                                  ($log->modul == 'Pelanggan' ? 'bg-blue-500' : 
                                  ($log->aksi == 'Hapus Data' || $log->aksi == 'Cabut Akses' ? 'bg-red-500' : 'bg-slate-500'))) }}">
                                
                                @if($log->modul == 'Voucher')
                                    <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                                @elseif($log->modul == 'Pelanggan')
                                    <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                @else
                                    <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                @endif
                            </div>

                            <div class="bg-slate-50 border border-slate-100 rounded-xl p-5 hover:shadow-md transition duration-300">
                                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start gap-2 mb-2">
                                    <div>
                                        <span class="inline-block px-2.5 py-0.5 rounded text-[10px] font-black uppercase tracking-widest mb-1
                                            {{ $log->modul == 'Keuangan' || $log->modul == 'Pembayaran' ? 'bg-emerald-100 text-emerald-700' : 
                                              ($log->modul == 'Voucher' ? 'bg-orange-100 text-orange-700' : 
                                              ($log->modul == 'Pelanggan' ? 'bg-blue-100 text-blue-700' : 'bg-slate-200 text-slate-700')) }}">
                                            Modul: {{ $log->modul }}
                                        </span>
                                        <h4 class="text-base font-bold text-slate-800">{{ $log->aksi }}</h4>
                                    </div>
                                    <div class="text-right flex flex-col items-start sm:items-end">
                                        <div class="flex items-center gap-2">
                                            <span class="text-xs font-bold text-slate-500 flex items-center gap-1">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                {{ $log->created_at->diffForHumans() }}
                                            </span>
                                            
                                            <form action="{{ route('boss.log.destroy', $log->id) }}" method="POST" onsubmit="return confirm('Hapus catatan aktivitas ini secara permanen?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-slate-300 hover:text-red-500 hover:bg-red-50 p-1 rounded transition opacity-0 group-hover:opacity-100" title="Hapus Log">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        </div>
                                        <span class="text-[10px] text-slate-400">{{ $log->created_at->format('d M Y - H:i') }} WIB</span>
                                    </div>
                                </div>
                                
                                <p class="text-sm text-slate-600 mb-3">{{ $log->keterangan }}</p>
                                
                                <div class="flex items-center gap-2 pt-3 border-t border-slate-200">
                                    <div class="w-6 h-6 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-black text-[10px]">
                                        {{ strtoupper(substr($log->user->name ?? 'S', 0, 1)) }}
                                    </div>
                                    <p class="text-xs font-semibold text-slate-500">Dilakukan oleh: <span class="text-slate-800 font-bold">{{ $log->user->name ?? 'Sistem Otomatis' }}</span></p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="pl-8 text-center py-10 text-slate-400 font-medium">
                            <svg class="w-12 h-12 text-slate-200 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            Belum ada aktivitas yang terekam di dalam sistem.
                        </div>
                    @endforelse

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
