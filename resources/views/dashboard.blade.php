<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#1a44a6] leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                
                <div class="bg-white rounded-xl p-4 shadow-sm border border-slate-200 hover:-translate-y-0.5 transition-all duration-300 flex items-center gap-3 overflow-hidden">
                    <div class="w-10 h-10 rounded-lg flex items-center justify-center shrink-0 bg-blue-50 text-[#0d6efd]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-0.5 truncate">Total Pelanggan</p>
                        <h3 class="text-lg lg:text-xl font-black text-[#0d6efd] leading-none truncate">{{ $totalPelanggan }}</h3>
                    </div>
                </div>

                <div class="bg-white rounded-xl p-4 shadow-sm border border-slate-200 hover:-translate-y-0.5 transition-all duration-300 flex items-center gap-3 overflow-hidden">
                    <div class="w-10 h-10 rounded-lg flex items-center justify-center shrink-0 bg-green-50 text-green-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-0.5 truncate">Pelanggan Aktif</p>
                        <h3 class="text-lg lg:text-xl font-black text-[#0d6efd] leading-none truncate">{{ $pelangganAktif }}</h3>
                    </div>
                </div>

                <div class="bg-white rounded-xl p-4 shadow-sm border border-slate-200 hover:-translate-y-0.5 transition-all duration-300 flex items-center gap-3 overflow-hidden">
                    <div class="w-10 h-10 rounded-lg flex items-center justify-center shrink-0 bg-purple-50 text-purple-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-0.5 truncate">Paket Tersedia</p>
                        <h3 class="text-lg lg:text-xl font-black text-[#0d6efd] leading-none truncate">{{ $totalPaket }}</h3>
                    </div>
                </div>

                <div class="bg-white rounded-xl p-4 shadow-sm border border-slate-200 hover:-translate-y-0.5 transition-all duration-300 flex items-center gap-3 overflow-hidden">
                    <div class="w-10 h-10 rounded-lg flex items-center justify-center shrink-0 bg-yellow-50 text-yellow-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-0.5 truncate">Pendapatan</p>
                        <h3 class="text-base lg:text-lg font-black text-[#0d6efd] tracking-tight leading-none whitespace-nowrap overflow-hidden text-ellipsis">Rp {{ number_format($pendapatanBulanIni, 0, ',', '.') }}</h3>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <div class="bg-white p-6 rounded-2xl shadow-sm shadow-slate-200/50 border border-slate-200 lg:col-span-1 flex flex-col">
                    <h3 class="text-sm font-bold text-[#1a44a6] mb-6 uppercase tracking-widest border-b border-slate-200 pb-3">Statistik Paket</h3>
                    <div class="relative w-full aspect-square max-h-64 mx-auto flex-1">
                        <canvas id="paketChart"></canvas>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm shadow-slate-200/50 border border-slate-200 lg:col-span-2 overflow-hidden flex flex-col">
                    <div class="p-6 border-b border-slate-200 flex justify-between items-center bg-slate-50/50">
                        <h3 class="text-sm font-bold text-[#1a44a6] uppercase tracking-widest">Monitoring Pelanggan Aktif</h3>
                        <a href="{{ route('pelanggan.index') }}" class="text-xs font-bold text-[#1a44a6] hover:text-blue-800 hover:underline">Lihat Semua &rarr;</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-slate-100">
                            <thead class="bg-slate-50">
                                <tr>
                                    <th class="px-6 py-4 text-left text-[10px] font-black text-slate-500 uppercase tracking-widest">Pelanggan</th>
                                    <th class="px-6 py-4 text-left text-[10px] font-black text-slate-500 uppercase tracking-widest">Paket</th>
                                    <th class="px-6 py-4 text-center text-[10px] font-black text-slate-500 uppercase tracking-widest">Tagihan Bulan Ini</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-slate-50">
                                @forelse($pelangganMonitoring->take(5) as $pelanggan)
                                    <tr class="hover:bg-blue-100/40/30 transition">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="font-bold text-[#1a44a6]">{{ $pelanggan->nama }}</div>
                                            <div class="text-xs text-slate-500">{{ $pelanggan->no_hp }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-3 py-1 bg-blue-100/40 text-blue-700 rounded-full text-xs font-bold">{{ $pelanggan->paket->nama_paket ?? '-' }}</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            @if(strtoupper($pelanggan->status_tagihan_bulan_ini) == 'LUNAS')
                                                <span class="inline-flex items-center px-2.5 py-1 rounded text-xs font-black bg-green-100 text-green-700 uppercase"><svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>Lunas</span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-1 rounded text-xs font-black bg-red-100 text-red-700 uppercase animate-pulse">Belum Bayar</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="3" class="px-6 py-12 text-center text-sm text-slate-500">Belum ada pelanggan aktif.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('paketChart').getContext('2d');
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($chartLabels) !!},
                    datasets: [{
                        data: {!! json_encode($chartData) !!},
                        backgroundColor: [
                            '#3b82f6', // Biru
                            '#8b5cf6', // Ungu
                            '#10b981', // Hijau
                            '#f59e0b', // Kuning
                            '#ef4444'  // Merah
                        ],
                        borderWidth: 0,
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'bottom', labels: { usePointStyle: true, boxWidth: 8, font: { size: 11, family: "'Figtree', sans-serif", weight: 'bold' } } }
                    },
                    cutout: '70%'
                }
            });
        });
    </script>
</x-app-layout>

