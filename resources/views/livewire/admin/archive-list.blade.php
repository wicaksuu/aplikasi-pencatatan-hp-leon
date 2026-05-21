<div>
    <div class="max-w-7xl mx-auto py-8">
        <!-- Header -->
        <div class="flex flex-col gap-6 mb-8">
            <h2 class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-sky-400 to-violet-400 tracking-tight">Daftar Arsip</h2>
            
            <div class="flex flex-col lg:flex-row gap-4 w-full p-1 justify-between items-start lg:items-center">
                <!-- Search -->
                <div class="relative w-full lg:w-96">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <input type="text" wire:model.live="search" class="w-full bg-black/20 backdrop-blur-md border border-white/10 text-gray-200 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-violet-500/50 rounded-xl pl-11 pr-4 py-3.5 transition-all shadow-inner" placeholder="Cari nama arsip..." />
                </div>

                <!-- Create Button -->
                <button wire:click="openCreateModal" class="btn bg-violet-600 hover:bg-violet-700 text-white border-0 rounded-xl px-6 h-12 shadow-lg shadow-violet-600/20 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                    Buat Arsip Baru
                </button>
            </div>
        </div>

        <!-- Table -->
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
                        @forelse ($archives as $archive)
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
                                    <button wire:click="openExportModal('excel', {{ $archive->id }})" title="Export Excel" class="btn btn-square btn-sm bg-emerald-500/20 text-emerald-400 border-emerald-500/30 hover:bg-emerald-500/40 hover:border-emerald-500/50 rounded-xl transition-all inline-flex">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                                    </button>
                                    <button wire:click="openExportModal('pdf', {{ $archive->id }})" title="Export PDF" class="btn btn-square btn-sm bg-red-500/20 text-red-400 border-red-500/30 hover:bg-red-500/40 hover:border-red-500/50 rounded-xl transition-all inline-flex">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" /></svg>
                                    </button>
                                    <a href="{{ route('admin.archives.detail', $archive->id) }}" title="Lihat Detail" class="btn btn-square btn-sm bg-sky-500/20 text-sky-400 border-sky-500/30 hover:bg-sky-500/40 hover:border-sky-500/50 rounded-xl transition-all inline-flex">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                    </a>
                                    <button wire:click="deleteArchive({{ $archive->id }})" title="Buang ke Sampah" class="btn btn-square btn-sm bg-red-500/20 text-red-400 border-red-500/30 hover:bg-red-500/40 hover:border-red-500/50 rounded-xl transition-all">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-12 text-gray-400 bg-transparent border-0">
                                    <div class="flex flex-col items-center justify-center space-y-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white/20" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" /></svg>
                                        <p class="text-lg">Belum ada arsip yang tersimpan.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($archives->hasPages())
                <div class="bg-black/40 border-t border-white/10 p-4">
                    {{ $archives->links(data: ['scrollTo' => false]) }}
                </div>
            @endif
        </div>
    </div>

    <!-- Create Modal -->
    @if($showCreateModal)
        <div class="fixed inset-0 z-[100] flex items-center justify-center p-4">
            <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" wire:click="closeCreateModal"></div>
            
            <div class="relative bg-slate-900 border border-white/10 rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden animate-fade-in-up">
                <div class="p-6 border-b border-white/5 bg-white/5 flex items-center justify-between">
                    <div>
                        <h3 class="text-xl font-bold text-white tracking-tight">Buat Arsip Baru</h3>
                        <p class="text-sm text-gray-400 mt-1">Simpan dan kelompokkan pesanan ke dalam arsip.</p>
                    </div>
                    <button wire:click="closeCreateModal" class="btn btn-sm btn-circle btn-ghost text-gray-400 hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>

                <div class="p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Nama Arsip</label>
                        <input type="text" wire:model="newArchiveName" placeholder="Contoh: Arsip Bulan Mei" class="w-full bg-black/30 border border-white/10 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-violet-500/50 rounded-xl px-4 py-3 transition-all" autofocus />
                        @error('newArchiveName') <p class="text-red-400 text-sm mt-2">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="p-6 border-t border-white/5 bg-white/5 flex justify-end gap-3">
                    <button wire:click="closeCreateModal" class="btn btn-ghost text-gray-300 hover:text-white border-white/10 hover:bg-white/10 rounded-xl px-6">Batal</button>
                    <button wire:click="createArchive" class="btn bg-violet-600 hover:bg-violet-700 text-white border-0 rounded-xl px-6 shadow-lg shadow-violet-600/20">Simpan Arsip</button>
                </div>
            </div>
        </div>
    @endif

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
                    <iframe src="{{ route('admin.export.pdf', ['archive_id' => $exportArchiveId]) }}" class="w-full h-full border-0 bg-white"></iframe>
                </div>

                <!-- Footer -->
                <div class="flex items-center justify-end px-6 py-4 border-t border-white/10 shrink-0 bg-black/20 gap-3">
                    <button wire:click="closeExportModal" class="btn btn-sm bg-white/5 hover:bg-white/10 text-gray-300 border border-white/10 rounded-xl transition-all">Tutup</button>
                    <a href="{{ route('admin.export.pdf', ['archive_id' => $exportArchiveId]) }}" target="_blank" class="btn btn-sm bg-gradient-to-r from-red-600 to-red-500 hover:from-red-500 hover:to-red-400 text-white border-0 rounded-xl shadow-lg shadow-red-500/20 transition-all flex items-center gap-2">
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
                    <a href="{{ route('admin.export.excel', ['archive_id' => $exportArchiveId]) }}" class="btn btn-sm bg-gradient-to-r from-emerald-600 to-emerald-500 hover:from-emerald-500 hover:to-emerald-400 text-white border-0 rounded-xl shadow-lg shadow-emerald-500/20 transition-all flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg>
                        Download Excel
                    </a>
                </div>
            </div>
        @endif
    </x-dark-modal>
</div>
