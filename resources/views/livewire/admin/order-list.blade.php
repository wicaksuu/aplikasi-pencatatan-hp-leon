<div class="card bg-white/5 backdrop-blur-xl border-y sm:border border-white/10 shadow-2xl w-full rounded-none sm:rounded-2xl">
    <div class="card-body p-3 sm:p-6 lg:p-8 text-white">
        
        <!-- Header & Filters -->
        <div class="flex flex-col gap-6 mb-8">
            <h2 class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-sky-400 to-violet-400 tracking-tight">Kelola Pesanan</h2>
            
            <div class="flex flex-col lg:flex-row gap-4 w-full p-1">
                <!-- Search -->
                <div class="relative w-full lg:flex-1">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" /></svg>
                    </div>
                    <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari barang atau nomor order..." class="w-full bg-black/20 backdrop-blur-md border border-white/10 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-violet-500/50 rounded-xl pl-11 pr-4 py-3.5 transition-all shadow-inner" />
                </div>
                
                <!-- Filters -->
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="flex flex-row items-center gap-2 w-full md:w-auto">
                        <select wire:model.live="platformFilter" class="w-full bg-black/20 backdrop-blur-md border border-white/10 text-gray-200 focus:outline-none focus:ring-2 focus:ring-violet-500/50 rounded-xl px-4 py-3.5 transition-all shadow-inner appearance-none cursor-pointer">
                            <option value="" class="bg-slate-900">Semua Platform</option>
                            @foreach($platforms as $platformName)
                                <option value="{{ $platformName }}" class="bg-slate-900">{{ $platformName }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex flex-row items-center gap-2 w-full">
                        <input type="date" wire:model.live="dateStart" class="w-full bg-black/20 backdrop-blur-md border border-white/10 text-gray-200 focus:outline-none focus:ring-2 focus:ring-violet-500/50 rounded-xl px-3 sm:px-4 py-3.5 transition-all shadow-inner" title="Tanggal Mulai" />
                        <span class="text-gray-400 font-bold">-</span>
                        <input type="date" wire:model.live="dateEnd" class="w-full bg-black/20 backdrop-blur-md border border-white/10 text-gray-200 focus:outline-none focus:ring-2 focus:ring-violet-500/50 rounded-xl px-3 sm:px-4 py-3.5 transition-all shadow-inner" title="Tanggal Akhir" />
                    </div>
                </div>
            </div>
        </div>


        <!-- Bulk Actions & Exports -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
            <div class="flex items-center gap-3">
                @if(count($selectedRows) > 0)
                    <div class="flex items-center gap-2 sm:gap-3 bg-white/5 border border-white/10 rounded-2xl p-1.5 shadow-inner backdrop-blur-sm animate-fade-in">
                        <span class="text-sm font-semibold text-sky-400 px-3">{{ count($selectedRows) }} Terpilih</span>
                        <div class="h-5 w-px bg-white/10"></div>
                        <div class="flex items-center gap-1 sm:gap-2 pr-1">
                            <button wire:click="promptArchive" class="btn btn-sm btn-ghost hover:bg-violet-500/20 text-violet-300 border-0 rounded-xl transition-all font-medium px-2 sm:px-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" /></svg>
                                <span class="hidden sm:inline">Arsipkan</span>
                            </button>
                            <button wire:click="deleteSelected" class="btn btn-sm btn-ghost hover:bg-red-500/20 text-red-400 border-0 rounded-xl transition-all font-medium px-2 sm:px-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                <span class="hidden sm:inline">Hapus</span>
                            </button>
                        </div>
                    </div>
                @endif
            </div>
            
            <div class="flex items-center gap-3">
                <button wire:click="openExportModal('excel')" class="btn btn-sm bg-emerald-500/10 text-emerald-400 border border-emerald-500/30 hover:bg-emerald-500/20 rounded-xl transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                    Excel
                </button>
                <button wire:click="openExportModal('pdf')" class="btn btn-sm bg-red-500/10 text-red-400 border border-red-500/30 hover:bg-red-500/20 rounded-xl transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                    PDF
                </button>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto bg-white/5 border border-white/10 rounded-2xl backdrop-blur-md">
            <table class="table table-sm w-full">
                <thead class="text-gray-300 border-b border-white/10 uppercase tracking-wider text-xs">
                    <tr>
                        <th class="bg-transparent border-0 w-10 whitespace-nowrap">
                            <label>
                                <input type="checkbox" class="checkbox checkbox-sm border-white/30 checked:bg-violet-500" wire:model.live="selectAll" />
                            </label>
                        </th>
                        <th class="bg-transparent border-0 font-medium whitespace-nowrap text-center">No</th>
                        <th class="bg-transparent border-0 font-medium whitespace-nowrap">Rincian Pesanan</th>
                        <th class="bg-transparent border-0 font-medium text-center whitespace-nowrap">Platform & Waktu</th>
                        <th class="bg-transparent border-0 font-medium text-center whitespace-nowrap">Qty</th>
                        <th class="bg-transparent border-0 font-medium text-right whitespace-nowrap">Harga</th>
                        <th class="bg-transparent border-0 font-medium text-right pr-4 whitespace-nowrap">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr class="border-b border-white/5 hover:bg-white/5 transition-colors duration-200">
                            <td class="bg-transparent border-0">
                                <label>
                                    <input type="checkbox" class="checkbox checkbox-sm border-white/30 checked:bg-violet-500" wire:model.live="selectedRows" value="{{ $order->id }}" />
                                </label>
                            </td>
                            <td class="whitespace-nowrap bg-transparent border-0 text-sm text-center text-gray-400 font-mono">{{ ($orders->currentPage() - 1) * $orders->perPage() + $loop->iteration }}</td>
                            <td class="bg-transparent border-0 whitespace-nowrap">
                                <div class="font-semibold text-white text-base mb-2">{{ $order->nama_barang }}</div>
                                <div class="flex flex-col items-start gap-1.5">
                                    <div class="text-[11px] font-mono text-sky-300 bg-sky-500/10 px-2 py-0.5 rounded border border-sky-500/20 leading-none">#{{ $order->no_order }}</div>
                                    @if($order->nomor_va)
                                        <div class="text-[11px] font-mono text-violet-300 bg-violet-500/10 px-2 py-0.5 rounded border border-violet-500/20 flex items-center gap-1 leading-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" /></svg>
                                            {{ $order->nomor_va }}
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="bg-transparent border-0 text-center whitespace-nowrap">
                                @php
                                    $pColor = $platformColors[$order->platform] ?? '#38bdf8';
                                @endphp
                                <div class="flex flex-col items-center gap-1.5">
                                    <div class="badge badge-sm font-medium px-3 py-2 rounded-lg shadow-sm" style="background-color: {{ $pColor }}20; border: 1px solid {{ $pColor }}50; color: {{ $pColor }};">
                                        {{ $order->platform }}
                                    </div>
                                    <span class="text-[11px] text-gray-400">{{ $order->created_at->format('d M Y H:i') }}</span>
                                </div>
                            </td>
                            <td class="bg-transparent border-0 text-center font-medium whitespace-nowrap">{{ $order->qty }}</td>
                            <td class="bg-transparent border-0 text-right font-medium tracking-tight whitespace-nowrap">Rp {{ number_format($order->harga, 0, ',', '.') }}</td>
                            <td class="text-right space-x-1 bg-transparent border-0 pr-4 whitespace-nowrap">
                                <button wire:click="deleteOrder({{ $order->id }})" title="Hapus" class="btn btn-square btn-sm bg-red-500/20 text-red-400 border-red-500/30 hover:bg-red-500/40 hover:border-red-500/50 rounded-xl transition-all">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-12 text-gray-400 bg-transparent border-0">
                                <div class="flex flex-col items-center justify-center space-y-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white/20" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" /></svg>
                                    <p class="text-lg">Belum ada data pesanan.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="mt-6">
            {{ $orders->links(data: ['scrollTo' => false]) }}
        </div>
    </div>

    <!-- Export Preview Modal -->
    <x-dark-modal wire:model="showExportModal" :maxWidth="$exportType === 'pdf' ? '7xl' : '5xl'">
        @if($exportType === 'pdf')
            <div class="flex flex-col h-[80vh]">
                <!-- Header -->
                <div class="flex items-center justify-between px-6 py-4 border-b border-white/10 shrink-0">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-red-500/10 border border-red-500/20 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" /></svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-white">Preview PDF</h3>
                            <p class="text-xs text-gray-400">Pratinjau dokumen langsung di browser</p>
                        </div>
                    </div>
                    <button wire:click="closeExportModal" class="btn btn-sm btn-ghost btn-square text-gray-400 hover:text-white hover:bg-white/10 rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>

                <!-- PDF Viewer -->
                <div class="flex-1 bg-black/40 overflow-hidden">
                    <iframe src="{{ route('admin.export.pdf') }}" class="w-full h-full border-0 bg-white"></iframe>
                </div>

                <!-- Footer -->
                <div class="flex items-center justify-end px-6 py-4 border-t border-white/10 shrink-0 bg-black/20 gap-3">
                    <button wire:click="closeExportModal" class="btn btn-sm bg-white/5 hover:bg-white/10 text-gray-300 border border-white/10 rounded-xl transition-all">Tutup</button>
                    <a href="{{ route('admin.export.pdf') }}" target="_blank" class="btn btn-sm bg-gradient-to-r from-red-600 to-red-500 hover:from-red-500 hover:to-red-400 text-white border-0 rounded-xl shadow-lg shadow-red-500/20 transition-all flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg>
                        Download PDF
                    </a>
                </div>
            </div>
        @else
            <div class="flex flex-col max-h-[85vh]">
                <!-- Header -->
                <div class="flex items-center justify-between px-6 py-4 border-b border-white/10 shrink-0">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-white">Preview Excel</h3>
                            <p class="text-xs text-gray-400">Pratinjau data sebelum mengunduh</p>
                        </div>
                    </div>
                    <button wire:click="closeExportModal" class="btn btn-sm btn-ghost btn-square text-gray-400 hover:text-white hover:bg-white/10 rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>

                <!-- Stats Summary -->
                <div class="grid grid-cols-3 gap-4 px-6 py-4 border-b border-white/10 shrink-0">
                    <div class="bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-center">
                        <p class="text-2xl font-bold text-white">{{ number_format($this->exportTotal, 0, ',', '.') }}</p>
                        <p class="text-xs text-gray-400 mt-0.5">Total Pesanan</p>
                    </div>
                    <div class="bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-center">
                        <p class="text-2xl font-bold text-white">{{ number_format($this->exportPreview->sum('qty'), 0, ',', '.') }}</p>
                        <p class="text-xs text-gray-400 mt-0.5">Total Unit</p>
                    </div>
                    <div class="bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-center">
                        <p class="text-2xl font-bold text-white text-sm sm:text-2xl">Rp {{ number_format($this->exportPreview->sum('harga'), 0, ',', '.') }}</p>
                        <p class="text-xs text-gray-400 mt-0.5">Total Nilai</p>
                    </div>
                </div>

                <!-- Spreadsheet Preview -->
                <div
                    x-data="{}"
                    x-ref="scrollContainer"
                    @scroll.debounce.250ms="
                        let el = $refs.scrollContainer;
                        if (el.scrollTop + el.clientHeight >= el.scrollHeight - 100) {
                            $wire.loadMoreExportPreview();
                        }
                    "
                    class="overflow-auto flex-1 px-6 py-4"
                >
                    <table class="w-full text-sm border border-white/10 rounded-lg overflow-hidden">
                        <thead class="bg-emerald-600 text-white text-xs uppercase tracking-wider">
                            <tr>
                                <th class="px-3 py-2.5 text-left font-medium border-r border-emerald-500/50">ID</th>
                                <th class="px-3 py-2.5 text-left font-medium border-r border-emerald-500/50">Nama Barang</th>
                                <th class="px-3 py-2.5 text-left font-medium border-r border-emerald-500/50">No Order</th>
                                <th class="px-3 py-2.5 text-left font-medium border-r border-emerald-500/50">Nomor VA</th>
                                <th class="px-3 py-2.5 text-center font-medium border-r border-emerald-500/50">Qty</th>
                                <th class="px-3 py-2.5 text-right font-medium border-r border-emerald-500/50">Harga</th>
                                <th class="px-3 py-2.5 text-left font-medium border-r border-emerald-500/50">Platform</th>
                                <th class="px-3 py-2.5 text-left font-medium">Tanggal Dibuat</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white/[0.03] text-gray-200">
                            @foreach($this->exportPreview as $order)
                                <tr class="border-b border-white/5 hover:bg-white/5 transition-colors">
                                    <td class="px-3 py-2 border-r border-white/5 font-mono text-gray-400">{{ $order->id }}</td>
                                    <td class="px-3 py-2 border-r border-white/5 font-medium text-white">{{ $order->nama_barang }}</td>
                                    <td class="px-3 py-2 border-r border-white/5 font-mono text-sky-300">{{ $order->no_order }}</td>
                                    <td class="px-3 py-2 border-r border-white/5 font-mono text-gray-400">{{ $order->nomor_va ?: '-' }}</td>
                                    <td class="px-3 py-2 border-r border-white/5 text-center">{{ $order->qty }}</td>
                                    <td class="px-3 py-2 border-r border-white/5 text-right font-mono">Rp {{ number_format($order->harga, 0, ',', '.') }}</td>
                                    <td class="px-3 py-2 border-r border-white/5">
                                        @php $pColorModal = $platformColors[$order->platform] ?? '#38bdf8'; @endphp
                                        <span class="badge badge-sm font-medium px-2 py-0.5 rounded-lg" style="background-color: {{ $pColorModal }}20; border: 1px solid {{ $pColorModal }}50; color: {{ $pColorModal }};">{{ $order->platform }}</span>
                                    </td>
                                    <td class="px-3 py-2 text-gray-400 font-mono text-xs">{{ $order->created_at->format('Y-m-d H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if($this->exportPreviewLimit < $this->exportTotal)
                        <div class="flex items-center justify-center gap-2 py-3 text-sm text-gray-500">
                            <span class="loading loading-dots loading-sm text-emerald-400"></span>
                            <span>Memuat lebih banyak...</span>
                        </div>
                    @else
                        <div class="text-center py-3 text-sm text-gray-500">
                            Semua {{ number_format($this->exportTotal, 0, ',', '.') }} pesanan telah dimuat.
                        </div>
                    @endif
                </div>

                <!-- Footer -->
                <div class="flex items-center justify-end px-6 py-4 border-t border-white/10 shrink-0 bg-black/20 gap-3">
                    <button wire:click="closeExportModal" class="btn btn-sm bg-white/5 hover:bg-white/10 text-gray-300 border border-white/10 rounded-xl transition-all">Tutup</button>
                    <a href="{{ route('admin.export.excel') }}" class="btn btn-sm bg-gradient-to-r from-emerald-600 to-emerald-500 hover:from-emerald-500 hover:to-emerald-400 text-white border-0 rounded-xl shadow-lg shadow-emerald-500/20 transition-all flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg>
                        Download Excel
                    </a>
                </div>
            </div>
        @endif
    </x-dark-modal>
</div>
