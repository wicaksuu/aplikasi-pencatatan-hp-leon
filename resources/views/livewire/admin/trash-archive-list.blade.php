<div>
    <div class="max-w-7xl mx-auto py-8">
        <!-- Header -->
        <div class="flex flex-col gap-6 mb-8">
            <h2 class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-red-400 to-violet-400 tracking-tight">Sampah Arsip</h2>
            
            <div class="flex flex-col lg:flex-row gap-4 w-full p-1">
                <!-- Search -->
                <div class="relative w-full lg:w-96">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <input type="text" wire:model.live="search" class="w-full bg-black/20 backdrop-blur-md border border-white/10 text-gray-200 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-violet-500/50 rounded-xl pl-11 pr-4 py-3.5 transition-all shadow-inner" placeholder="Cari nama arsip..." />
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="bg-black/20 backdrop-blur-xl border border-white/10 rounded-2xl overflow-hidden shadow-2xl">
            <div class="overflow-x-auto">
                <table class="table w-full border-collapse">
                    <thead>
                        <tr class="bg-white/5 text-gray-400 border-b border-white/10 text-sm tracking-wider">
                            <th class="py-4 font-semibold text-left border-0 pl-6 rounded-tl-2xl">Nama Arsip</th>
                            <th class="py-4 font-semibold text-center border-0">Jumlah Pesanan</th>
                            <th class="py-4 font-semibold text-center border-0">Dihapus Pada</th>
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
                                    <span class="px-3 py-1 bg-violet-500/10 text-violet-300 rounded-lg border border-violet-500/20">{{ $archive->orders_count }} Item</span>
                                </td>
                                <td class="bg-transparent border-0 text-center text-gray-400 whitespace-nowrap">{{ $archive->deleted_at->format('d M Y H:i') }}</td>
                                <td class="text-right space-x-1 bg-transparent border-0 pr-6 whitespace-nowrap">
                                    <button wire:click="restoreArchive({{ $archive->id }})" title="Pulihkan" class="btn btn-square btn-sm bg-emerald-500/20 text-emerald-400 border-emerald-500/30 hover:bg-emerald-500/40 hover:border-emerald-500/50 rounded-xl transition-all">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg>
                                    </button>
                                    <button wire:click="forceDeleteArchive({{ $archive->id }})" title="Hapus Permanen" class="btn btn-square btn-sm bg-red-500/20 text-red-400 border-red-500/30 hover:bg-red-500/40 hover:border-red-500/50 rounded-xl transition-all">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-12 text-gray-400 bg-transparent border-0">
                                    <div class="flex flex-col items-center justify-center space-y-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white/20" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" /></svg>
                                        <p class="text-lg">Sampah arsip kosong.</p>
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
</div>
