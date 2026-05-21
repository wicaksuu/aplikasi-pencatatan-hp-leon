<div class="card bg-white/5 backdrop-blur-xl border border-white/10 shadow-2xl w-full rounded-2xl">
    <div class="card-body p-4 sm:p-6 lg:p-8 text-white">
        
        <!-- Header & Filters -->
        <div class="flex flex-col gap-6 mb-8">
            <div>
                <h2 class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-sky-400 to-violet-400 tracking-tight">Dashboard Statistik</h2>
                <p class="text-gray-400 text-sm mt-1">Ringkasan keseluruhan data di sistem (Pesanan, Arsip & Sampah).</p>
            </div>
            
            <div class="flex flex-col lg:flex-row gap-4 w-full p-1">
                <!-- Filters -->
                <div class="flex flex-col sm:flex-row gap-4 w-full lg:max-w-md">
                    <div class="flex flex-row items-center gap-2 w-full">
                        <input type="date" wire:model.live="dateStart" class="w-full bg-black/20 backdrop-blur-md border border-white/10 text-gray-200 focus:outline-none focus:ring-2 focus:ring-violet-500/50 rounded-xl px-3 sm:px-4 py-3.5 transition-all shadow-inner" title="Tanggal Mulai" />
                        <span class="text-gray-400 font-bold">-</span>
                        <input type="date" wire:model.live="dateEnd" class="w-full bg-black/20 backdrop-blur-md border border-white/10 text-gray-200 focus:outline-none focus:ring-2 focus:ring-violet-500/50 rounded-xl px-3 sm:px-4 py-3.5 transition-all shadow-inner" title="Tanggal Akhir" />
                    </div>
                </div>
            </div>
        </div>

        <!-- Overall Summary Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <!-- Total Inv -->
            <div class="bg-black/20 backdrop-blur-md border border-white/10 rounded-2xl p-6 shadow-2xl relative overflow-hidden group hover:border-sky-500/30 transition-all duration-300">
                <div class="absolute -right-6 -top-6 text-sky-500/10 group-hover:text-sky-500/20 group-hover:scale-110 transition-all duration-300 transform">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-32 w-32" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" /></svg>
                </div>
                <div class="relative z-10">
                    <p class="text-xs font-semibold text-sky-400 uppercase tracking-wider mb-1">Total Inv</p>
                    <h3 class="text-3xl font-bold text-white tracking-tight">{{ number_format($totalOrders, 0, ',', '.') }} <span class="text-sm font-medium text-gray-400 normal-case tracking-normal">Invoice</span></h3>
                </div>
            </div>
            
            <!-- Total Barang -->
            <div class="bg-black/20 backdrop-blur-md border border-white/10 rounded-2xl p-6 shadow-2xl relative overflow-hidden group hover:border-violet-500/30 transition-all duration-300">
                <div class="absolute -right-6 -top-6 text-violet-500/10 group-hover:text-violet-500/20 group-hover:scale-110 transition-all duration-300 transform">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-32 w-32" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" /></svg>
                </div>
                <div class="relative z-10">
                    <p class="text-xs font-semibold text-violet-400 uppercase tracking-wider mb-1">Total Barang</p>
                    <h3 class="text-3xl font-bold text-white tracking-tight">{{ number_format($totalItems, 0, ',', '.') }} <span class="text-sm font-medium text-gray-400 normal-case tracking-normal">Unit</span></h3>
                </div>
            </div>
            
            <!-- Total Harga -->
            <div class="bg-black/20 backdrop-blur-md border border-white/10 rounded-2xl p-6 shadow-2xl relative overflow-hidden group hover:border-emerald-500/30 transition-all duration-300 sm:col-span-2 lg:col-span-1">
                <div class="absolute -right-6 -top-6 text-emerald-500/10 group-hover:text-emerald-500/20 group-hover:scale-110 transition-all duration-300 transform">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-32 w-32" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <div class="relative z-10">
                    <p class="text-xs font-semibold text-emerald-400 uppercase tracking-wider mb-1">Total Harga</p>
                    <h3 class="text-3xl font-bold text-white tracking-tight">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>

        <!-- Status Breakdown Cards -->
        <div class="mb-8">
            <h3 class="text-xl font-bold text-white mb-4 tracking-tight">Rincian Status Data</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- Active -->
                <div class="bg-black/20 backdrop-blur-md border border-white/10 rounded-2xl p-5 hover:bg-white/5 transition-all group">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center border border-white/20 bg-sky-500/20 text-sky-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <h4 class="text-lg font-bold text-white">Pesanan Aktif</h4>
                    </div>
                    <div class="space-y-1.5">
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-gray-400">Total Inv</span>
                            <span class="font-medium text-white">{{ number_format($activeOrders, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-gray-400">Total Barang</span>
                            <span class="font-medium text-white">{{ number_format($activeItems, 0, ',', '.') }} Unit</span>
                        </div>
                        <div class="pt-2 mt-2 border-t border-white/10 flex justify-between items-center">
                            <span class="text-gray-400 text-xs">Total Harga</span>
                            <span class="font-bold text-emerald-400">Rp {{ number_format($activeRevenue, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Archived -->
                <div class="bg-black/20 backdrop-blur-md border border-white/10 rounded-2xl p-5 hover:bg-white/5 transition-all group">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center border border-white/20 bg-violet-500/20 text-violet-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" /></svg>
                        </div>
                        <h4 class="text-lg font-bold text-white">Pesanan Terarsip</h4>
                    </div>
                    <div class="space-y-1.5">
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-gray-400">Total Inv</span>
                            <span class="font-medium text-white">{{ number_format($archivedOrders, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-gray-400">Total Barang</span>
                            <span class="font-medium text-white">{{ number_format($archivedItems, 0, ',', '.') }} Unit</span>
                        </div>
                        <div class="pt-2 mt-2 border-t border-white/10 flex justify-between items-center">
                            <span class="text-gray-400 text-xs">Total Harga</span>
                            <span class="font-bold text-emerald-400">Rp {{ number_format($archivedRevenue, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Trashed -->
                <div class="bg-black/20 backdrop-blur-md border border-white/10 rounded-2xl p-5 hover:bg-white/5 transition-all group">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center border border-white/20 bg-red-500/20 text-red-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                        </div>
                        <h4 class="text-lg font-bold text-white">Pesanan di Sampah</h4>
                    </div>
                    <div class="space-y-1.5">
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-gray-400">Total Inv</span>
                            <span class="font-medium text-white">{{ number_format($trashedOrders, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-gray-400">Total Barang</span>
                            <span class="font-medium text-white">{{ number_format($trashedItems, 0, ',', '.') }} Unit</span>
                        </div>
                        <div class="pt-2 mt-2 border-t border-white/10 flex justify-between items-center">
                            <span class="text-gray-400 text-xs">Total Harga</span>
                            <span class="font-bold text-emerald-400">Rp {{ number_format($trashedRevenue, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Total Archives -->
                <div class="bg-black/20 backdrop-blur-md border border-white/10 rounded-2xl p-5 hover:bg-white/5 transition-all group">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center border border-white/20 bg-amber-500/20 text-amber-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" /></svg>
                        </div>
                        <h4 class="text-lg font-bold text-white">Total Arsip</h4>
                    </div>
                    <div class="space-y-1.5">
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-gray-400">Jumlah Arsip</span>
                            <span class="font-medium text-white">{{ number_format($totalArchives, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-gray-400">Status</span>
                            <span class="font-medium text-amber-400">Aktif</span>
                        </div>
                        <div class="pt-2 mt-2 border-t border-white/10 flex justify-end items-center">
                            <a href="{{ route('admin.archives') }}" class="text-xs text-sky-400 hover:text-sky-300 transition-colors font-medium">Lihat Semua Arsip →</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top 5 Barang Terbanyak -->
        @if($topItems->count() > 0)
        <div class="mb-8">
            <h3 class="text-xl font-bold text-white mb-4 tracking-tight">Top 5 Barang Terbanyak</h3>
            <div class="bg-black/20 backdrop-blur-xl border border-white/10 rounded-2xl overflow-hidden shadow-2xl">
                <div class="overflow-x-auto">
                    <table class="table w-full border-collapse">
                        <thead>
                            <tr class="bg-white/5 text-gray-400 border-b border-white/10 text-sm tracking-wider">
                                <th class="py-4 font-semibold text-left border-0 pl-6 rounded-tl-2xl w-16">#</th>
                                <th class="py-4 font-semibold text-left border-0">Nama Barang</th>
                                <th class="py-4 font-semibold text-center border-0">Total Inv</th>
                                <th class="py-4 font-semibold text-center border-0">Total Barang</th>
                                <th class="py-4 font-semibold text-right border-0 pr-6 rounded-tr-2xl">Total Harga</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-300 divide-y divide-white/5">
                            @foreach($topItems as $index => $item)
                                <tr class="hover:bg-white/5 transition-colors duration-200 group border-0">
                                    <td class="bg-transparent border-0 pl-6">
                                        <div class="w-8 h-8 rounded-lg flex items-center justify-center text-sm font-bold
                                            {{ $index === 0 ? 'bg-yellow-500/20 text-yellow-400 border border-yellow-500/30' : ($index === 1 ? 'bg-gray-300/20 text-gray-300 border border-gray-300/30' : ($index === 2 ? 'bg-amber-600/20 text-amber-500 border border-amber-600/30' : 'bg-white/5 text-gray-400 border border-white/10')) }}">
                                            {{ $index + 1 }}
                                        </div>
                                    </td>
                                    <td class="bg-transparent border-0">
                                        <span class="font-bold text-white tracking-tight">{{ $item->nama_barang }}</span>
                                    </td>
                                    <td class="bg-transparent border-0 text-center font-medium whitespace-nowrap">
                                        <span class="px-3 py-1 bg-sky-500/10 text-sky-300 rounded-lg border border-sky-500/20">{{ number_format($item->total_orders, 0, ',', '.') }} Inv</span>
                                    </td>
                                    <td class="bg-transparent border-0 text-center font-medium whitespace-nowrap">
                                        <span class="px-3 py-1 bg-emerald-500/10 text-emerald-300 rounded-lg border border-emerald-500/20">{{ number_format($item->total_qty, 0, ',', '.') }} Item</span>
                                    </td>
                                    <td class="bg-transparent border-0 text-right font-medium tracking-tight whitespace-nowrap pr-6">
                                        <span class="text-white">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif

        <!-- Charts -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8"
             x-data="{
                 platformLabels: @js($platformBreakdown->pluck('platform')->values()->toArray()),
                 platformRevenues: @js($platformBreakdown->pluck('total_revenue')->values()->toArray()),
                 platformColors: @js($platformBreakdown->map(fn($p) => $platformColors[$p->platform] ?? '#38bdf8')->values()->toArray()),
                 statusLabels: ['Pesanan Aktif', 'Arsip', 'Sampah'],
                 statusData: [{{ $activeOrders }}, {{ $archivedOrders }}, {{ $trashedOrders }}],
                 statusColors: ['#0ea5e9', '#8b5cf6', '#ef4444']
             }"
             x-init="
                const formatRupiah = (value) => {
                    if (value >= 1000000000) return (value / 1000000000).toFixed(1).replace(/\.0$/, '') + ' M';
                    if (value >= 1000000) return (value / 1000000).toFixed(1).replace(/\.0$/, '') + ' jt';
                    if (value >= 1000) return (value / 1000).toFixed(1).replace(/\.0$/, '') + ' rb';
                    return value.toString();
                };

                const commonOptions = {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { labels: { color: '#9ca3af', font: { family: 'Outfit' } } }
                    }
                };

                new Chart($refs.platformChart, {
                    type: 'bar',
                    data: {
                        labels: platformLabels,
                        datasets: [{
                            label: 'Pendapatan',
                            data: platformRevenues,
                            backgroundColor: platformColors,
                            borderRadius: 8,
                            borderSkipped: false
                        }]
                    },
                    options: {
                        ...commonOptions,
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: { color: 'rgba(255,255,255,0.05)' },
                                ticks: {
                                    color: '#9ca3af',
                                    font: { family: 'Outfit' },
                                    callback: function(value) { return formatRupiah(value); }
                                }
                            },
                            x: {
                                grid: { display: false },
                                ticks: { color: '#9ca3af', font: { family: 'Outfit' } }
                            }
                        },
                        plugins: {
                            ...commonOptions.plugins,
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return 'Rp ' + new Intl.NumberFormat('id-ID').format(context.raw);
                                    }
                                }
                            }
                        }
                    }
                });

                new Chart($refs.statusChart, {
                    type: 'doughnut',
                    data: {
                        labels: statusLabels,
                        datasets: [{
                            data: statusData,
                            backgroundColor: statusColors,
                            borderWidth: 0,
                            hoverOffset: 8
                        }]
                    },
                    options: {
                        ...commonOptions,
                        cutout: '65%',
                        plugins: {
                            legend: { position: 'bottom', labels: { color: '#9ca3af', padding: 16, font: { family: 'Outfit' } } }
                        }
                    }
                });
             ">
            <div class="bg-black/20 backdrop-blur-md border border-white/10 rounded-2xl p-5 shadow-2xl">
                <h3 class="text-lg font-bold text-white mb-4 tracking-tight">Pendapatan per Platform</h3>
                <div class="relative h-64">
                    <canvas x-ref="platformChart"></canvas>
                </div>
            </div>
            <div class="bg-black/20 backdrop-blur-md border border-white/10 rounded-2xl p-5 shadow-2xl">
                <h3 class="text-lg font-bold text-white mb-4 tracking-tight">Distribusi Status Pesanan</h3>
                <div class="relative h-64">
                    <canvas x-ref="statusChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Top Archives -->
        @if($topArchives->count() > 0)
        <div class="mb-8">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-bold text-white tracking-tight">Arsip Terbaru</h3>
                <a href="{{ route('admin.archives') }}" class="text-sm text-sky-400 hover:text-sky-300 transition-colors font-medium">Lihat Semua →</a>
            </div>
            <div class="bg-black/20 backdrop-blur-xl border border-white/10 rounded-2xl overflow-hidden shadow-2xl">
                <div class="overflow-x-auto">
                    <table class="table w-full border-collapse">
                        <thead>
                            <tr class="bg-white/5 text-gray-400 border-b border-white/10 text-sm tracking-wider">
                                <th class="py-4 font-semibold text-left border-0 pl-6 rounded-tl-2xl">Nama Arsip</th>
                                <th class="py-4 font-semibold text-center border-0">Total Inv</th>
                                <th class="py-4 font-semibold text-center border-0">Total Barang</th>
                                <th class="py-4 font-semibold text-right border-0">Total Harga</th>
                                <th class="py-4 font-semibold text-center border-0">Tanggal Dibuat</th>
                                <th class="py-4 font-semibold text-right border-0 pr-6 rounded-tr-2xl">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-300 divide-y divide-white/5">
                            @foreach($topArchives as $archive)
                                <tr class="hover:bg-white/5 transition-colors duration-200 group border-0">
                                    <td class="bg-transparent border-0 pl-6">
                                        <span class="font-bold text-white tracking-tight">{{ $archive->name }}</span>
                                    </td>
                                    <td class="bg-transparent border-0 text-center font-medium whitespace-nowrap">
                                        <span class="px-3 py-1 bg-sky-500/10 text-sky-300 rounded-lg border border-sky-500/20">{{ number_format($archive->orders_count, 0, ',', '.') }} Inv</span>
                                    </td>
                                    <td class="bg-transparent border-0 text-center font-medium whitespace-nowrap">
                                        <span class="px-3 py-1 bg-emerald-500/10 text-emerald-300 rounded-lg border border-emerald-500/20">{{ number_format($archive->orders_sum_qty ?? 0, 0, ',', '.') }} Item</span>
                                    </td>
                                    <td class="bg-transparent border-0 text-right font-medium tracking-tight whitespace-nowrap">
                                        <span class="text-white">Rp {{ number_format($archive->orders_sum_harga ?? 0, 0, ',', '.') }}</span>
                                    </td>
                                    <td class="bg-transparent border-0 text-center text-gray-400 whitespace-nowrap">{{ $archive->created_at->format('d M Y') }}</td>
                                    <td class="text-right space-x-1 bg-transparent border-0 pr-6 whitespace-nowrap">
                                        <a href="{{ route('admin.archives.detail', $archive->id) }}" title="Lihat Detail" class="btn btn-square btn-sm bg-sky-500/20 text-sky-400 border-sky-500/30 hover:bg-sky-500/40 hover:border-sky-500/50 rounded-xl transition-all inline-flex">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif

        <!-- Platform Breakdown -->
        <div class="mt-4">
            <h3 class="text-xl font-bold text-white mb-4 tracking-tight">Rincian Pendapatan per Platform</h3>
            <div class="space-y-3">
                @forelse($platformBreakdown as $platform)
                    @php
                        $pColor = $platformColors[$platform->platform] ?? '#38bdf8';
                    @endphp
                    <div class="bg-black/20 backdrop-blur-md border border-white/10 rounded-2xl p-4 sm:p-5 hover:bg-white/5 transition-all group">
                        <div class="flex flex-col xl:flex-row xl:items-center gap-4 xl:gap-6">
                            <!-- Platform Name -->
                            <div class="flex items-center gap-3 xl:w-44 shrink-0">
                                <div class="w-10 h-10 rounded-xl flex items-center justify-center border border-white/20 shrink-0" style="background-color: {{ $pColor }}30; color: {{ $pColor }};">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
                                </div>
                                <h4 class="text-lg font-bold text-white">{{ $platform->platform }}</h4>
                            </div>
                            
                            <!-- Stats Grid -->
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 flex-1 min-w-0">
                                <!-- Pesanan Aktif -->
                                <div class="bg-sky-500/5 border border-sky-500/10 rounded-xl p-3">
                                    <p class="text-[10px] font-semibold text-sky-400 uppercase tracking-wider mb-2">Pesanan Aktif</p>
                                    <div class="flex items-center justify-between gap-2 text-xs whitespace-nowrap">
                                        <span class="text-gray-400">Inv: <span class="text-white font-medium">{{ number_format($platform->active_orders, 0, ',', '.') }}</span></span>
                                        <span class="text-gray-400">Brg: <span class="text-white font-medium">{{ number_format($platform->active_items, 0, ',', '.') }}</span></span>
                                    </div>
                                    <div class="mt-1 text-xs text-emerald-400 font-medium whitespace-nowrap">Rp {{ number_format($platform->active_revenue, 0, ',', '.') }}</div>
                                </div>

                                <!-- Arsip -->
                                <div class="bg-violet-500/5 border border-violet-500/10 rounded-xl p-3">
                                    <p class="text-[10px] font-semibold text-violet-400 uppercase tracking-wider mb-2">Arsip</p>
                                    <div class="flex items-center justify-between gap-2 text-xs whitespace-nowrap">
                                        <span class="text-gray-400">Inv: <span class="text-white font-medium">{{ number_format($platform->archived_orders, 0, ',', '.') }}</span></span>
                                        <span class="text-gray-400">Brg: <span class="text-white font-medium">{{ number_format($platform->archived_items, 0, ',', '.') }}</span></span>
                                    </div>
                                    <div class="mt-1 text-xs text-emerald-400 font-medium whitespace-nowrap">Rp {{ number_format($platform->archived_revenue, 0, ',', '.') }}</div>
                                </div>

                                <!-- Sampah -->
                                <div class="bg-red-500/5 border border-red-500/10 rounded-xl p-3">
                                    <p class="text-[10px] font-semibold text-red-400 uppercase tracking-wider mb-2">Sampah</p>
                                    <div class="flex items-center justify-between gap-2 text-xs whitespace-nowrap">
                                        <span class="text-gray-400">Inv: <span class="text-white font-medium">{{ number_format($platform->trashed_orders, 0, ',', '.') }}</span></span>
                                        <span class="text-gray-400">Brg: <span class="text-white font-medium">{{ number_format($platform->trashed_items, 0, ',', '.') }}</span></span>
                                    </div>
                                    <div class="mt-1 text-xs text-emerald-400 font-medium whitespace-nowrap">Rp {{ number_format($platform->trashed_revenue, 0, ',', '.') }}</div>
                                </div>
                            </div>
                            
                            <!-- Total -->
                            <div class="xl:w-44 shrink-0 xl:text-right flex flex-row xl:flex-col items-center xl:items-end justify-between xl:justify-center gap-2 border-t xl:border-t-0 xl:border-l border-white/10 pt-3 xl:pt-0 xl:pl-6">
                                <p class="text-xs text-gray-400">Total Pendapatan</p>
                                <p class="text-sm font-bold text-emerald-400 whitespace-nowrap">Rp {{ number_format($platform->total_revenue, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-black/20 border border-white/10 rounded-2xl p-8 text-center text-gray-400">
                        <div class="flex flex-col items-center justify-center space-y-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white/20" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" /></svg>
                            <p>Belum ada data pendapatan dari platform manapun untuk rentang tanggal ini.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
