<div>
    @if($isOpen)
        <!-- Backdrop -->
        <div class="fixed inset-0 z-[100] flex items-center justify-center p-4">
            <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" wire:click="closeModal"></div>
            
            <!-- Modal Content -->
            <div class="relative bg-slate-900 border border-white/10 rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden animate-fade-in-up">
                <!-- Header -->
                <div class="p-6 border-b border-white/5 bg-white/5 flex items-center justify-between">
                    <div>
                        <h3 class="text-xl font-bold text-white tracking-tight">Pilih Arsip</h3>
                        <p class="text-sm text-gray-400 mt-1">Memindahkan {{ count($selectedOrderIds) }} pesanan terpilih.</p>
                    </div>
                    <button wire:click="closeModal" class="btn btn-sm btn-circle btn-ghost text-gray-400 hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>

                <!-- Body -->
                <div class="p-6 space-y-4">
                    <!-- Search Input -->
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" /></svg>
                        </div>
                        <input type="text" wire:model.live.debounce.250ms="searchArchive" placeholder="Cari nama arsip..." class="w-full bg-black/30 border border-white/10 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-violet-500/50 rounded-xl pl-10 pr-4 py-3 transition-all" autofocus />
                    </div>

                    <!-- Archive List -->
                    <div class="max-h-64 overflow-y-auto pr-2 space-y-2 custom-scrollbar">
                        @forelse($this->archives as $archive)
                            <button wire:click="moveToArchive({{ $archive->id }})" class="w-full text-left bg-white/5 hover:bg-violet-500/20 border border-transparent hover:border-violet-500/30 rounded-xl p-3 flex items-center justify-between transition-all group">
                                <div class="flex items-center gap-3">
                                    <div class="p-2 bg-violet-500/20 text-violet-400 rounded-lg group-hover:bg-violet-500 group-hover:text-white transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" /></svg>
                                    </div>
                                    <div>
                                        <div class="text-gray-200 font-medium">{{ $archive->name }}</div>
                                        <div class="text-xs text-gray-500">{{ $archive->orders()->count() }} pesanan</div>
                                    </div>
                                </div>
                                <div class="text-violet-400 opacity-0 group-hover:opacity-100 transition-opacity flex items-center gap-2">
                                    <span class="text-xs">Pilih</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                                </div>
                            </button>
                        @empty
                            @if(!empty($searchArchive))
                                <div class="text-center py-6">
                                    <div class="w-16 h-16 bg-white/5 rounded-full flex items-center justify-center mx-auto mb-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" /></svg>
                                    </div>
                                    <p class="text-gray-400 mb-4">Arsip "{{ $searchArchive }}" tidak ditemukan.</p>
                                    <button wire:click="createNewArchive" class="btn btn-sm bg-violet-600 hover:bg-violet-700 text-white border-0 rounded-xl px-6 h-10">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                                        Buat Arsip "{{ $searchArchive }}"
                                    </button>
                                </div>
                            @else
                                <div class="text-center py-6 text-gray-500">
                                    Belum ada arsip yang dibuat.
                                </div>
                            @endif
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
