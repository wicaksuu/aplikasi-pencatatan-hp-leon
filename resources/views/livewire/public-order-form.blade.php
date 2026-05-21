<div class="relative group w-full">
    <!-- Glowing backdrop effect for the card -->
    <div class="absolute -inset-1 bg-gradient-to-r from-violet-600/40 to-sky-500/40 rounded-2xl blur-lg opacity-0 lg:opacity-25 lg:group-hover:opacity-40 transition duration-1000 group-hover:duration-200"></div>
    
    <div class="relative bg-[#0d1117]/80 lg:bg-black/40 backdrop-blur-xl border border-white/10 p-6 sm:p-8 rounded-2xl shadow-2xl w-full">
        <h2 class="text-2xl font-bold mb-6 text-white">Input Pesanan Baru</h2>
        
        @if (session()->has('message'))
            <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 px-4 py-3 rounded-xl mb-6 flex items-center gap-3 backdrop-blur-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <span class="text-sm font-medium">{{ session('message') }}</span>
            </div>
        @endif

        @if(!$inputEnabled)
            <div class="flex flex-col items-center justify-center py-12 px-6">
                <!-- Animated Lock Icon -->
                <div class="relative mb-8">
                    <div class="absolute inset-0 bg-red-500/20 rounded-full blur-2xl animate-pulse"></div>
                    <div class="relative w-20 h-20 bg-gradient-to-br from-red-500/20 to-orange-500/10 border border-red-500/20 rounded-full flex items-center justify-center backdrop-blur-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                        </svg>
                    </div>
                </div>

                <!-- Status Badge -->
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-red-500/10 border border-red-500/20 mb-5">
                    <span class="flex h-2 w-2 relative">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-red-500"></span>
                    </span>
                    <span class="text-xs font-semibold text-red-400 uppercase tracking-wider">Tidak Tersedia</span>
                </div>

                <!-- Text -->
                <h3 class="text-xl font-bold text-white mb-2 tracking-tight">Input Pesanan Ditutup</h3>
                <p class="text-sm text-gray-400 text-center max-w-xs leading-relaxed mb-8">
                    Fitur input pesanan baru sedang dinonaktifkan sementara oleh admin. Silakan coba lagi nanti.
                </p>

                <!-- Contact Admin Button -->
                @auth
                <a href="{{ url('/dashboard') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-white/5 hover:bg-white/10 text-sm text-gray-300 hover:text-white font-medium rounded-xl border border-white/10 hover:border-white/20 transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1" /></svg>
                    Dashboard
                </a>
                @else
                <a href="{{ route('login') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-white/5 hover:bg-white/10 text-sm text-gray-300 hover:text-white font-medium rounded-xl border border-white/10 hover:border-white/20 transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" /></svg>
                    Masuk sebagai Admin
                </a>
                @endauth
            </div>
        @else
        <form wire:submit.prevent="submit" class="space-y-5">
            
            <div class="space-y-1.5 relative" x-data="{ open: false }" @click.outside="open = false">
                <label class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Nama Barang</label>
                <input type="text" 
                    wire:model.live.debounce.300ms="nama_barang" 
                    wire:keyup="searchBarang"
                    @focus="open = true"
                    @input="open = true"
                    placeholder="Contoh: iPhone 15 Pro Max" 
                    autocomplete="off"
                    class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-violet-500/50 focus:border-violet-500/30 transition-all duration-200" />
                
                <!-- Autocomplete Suggestions Dropdown -->
                @if(count($suggestions) > 0)
                <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                    class="absolute z-50 w-full mt-1 bg-[#0d1117] border border-white/10 rounded-xl shadow-2xl shadow-black/50 overflow-hidden backdrop-blur-xl">
                    @foreach($suggestions as $suggestion)
                        <button type="button"
                            wire:click="selectBarang('{{ addslashes($suggestion) }}')"
                            @click="open = false"
                            class="w-full text-left px-4 py-3 text-sm text-gray-300 hover:bg-violet-500/20 hover:text-white transition-colors duration-150 flex items-center gap-3 border-b border-white/5 last:border-b-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                            <span>{{ $suggestion }}</span>
                        </button>
                    @endforeach
                </div>
                @endif

                @error('nama_barang') <span class="text-red-400 text-xs font-medium">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label class="text-xs font-semibold text-gray-400 uppercase tracking-wider">No Order</label>
                    <input type="text" wire:model="no_order" placeholder="INV-001..." class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-violet-500/50 focus:border-violet-500/30 transition-all duration-200" />
                    @error('no_order') <span class="text-red-400 text-xs font-medium">{{ $message }}</span> @enderror
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Nomor VA (Opsional)</label>
                    <input type="text" wire:model="nomor_va" placeholder="880123..." class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-violet-500/50 focus:border-violet-500/30 transition-all duration-200" />
                    @error('nomor_va') <span class="text-red-400 text-xs font-medium">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Quantity</label>
                    <input type="number" wire:model="qty" min="1" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-violet-500/50 focus:border-violet-500/30 transition-all duration-200" />
                    @error('qty') <span class="text-red-400 text-xs font-medium">{{ $message }}</span> @enderror
                </div>

                <div class="space-y-1.5" x-data="{
                    formatted: '',
                    init() {
                        if ($wire.harga) {
                            this.formatted = Number($wire.harga).toLocaleString('id-ID');
                        }
                    },
                    formatCurrency(e) {
                        let raw = e.target.value.replace(/\D/g, '');
                        if (raw === '') {
                            this.formatted = '';
                            $wire.set('harga', null);
                            return;
                        }
                        let num = parseInt(raw, 10);
                        this.formatted = num.toLocaleString('id-ID');
                        $wire.set('harga', num);
                    }
                }">
                    <label class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Harga (Rp)</label>
                    <input type="text" inputmode="numeric" x-model="formatted" @input="formatCurrency($event)" placeholder="0" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-violet-500/50 focus:border-violet-500/30 transition-all duration-200" />
                    @error('harga') <span class="text-red-400 text-xs font-medium">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="space-y-1.5">
                <label class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Platform E-Commerce</label>
                <div class="relative">
                    <select wire:model="platform" class="w-full bg-[#0d1117] border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-violet-500/50 focus:border-violet-500/30 transition-all duration-200 appearance-none cursor-pointer pr-10">
                        <option value="" disabled>Pilih Platform...</option>
                        @foreach($platforms as $plat)
                            <option value="{{ $plat }}">{{ $plat }}</option>
                        @endforeach
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </div>
                </div>
                @error('platform') <span class="text-red-400 text-xs font-medium">{{ $message }}</span> @enderror
            </div>

            <div class="pt-2">
                <button type="submit" class="w-full py-3.5 px-4 bg-gradient-to-r from-violet-600 to-sky-500 hover:from-violet-500 hover:to-sky-400 text-white font-semibold rounded-xl shadow-[0_0_20px_rgba(124,58,237,0.3)] hover:shadow-[0_0_30px_rgba(124,58,237,0.5)] transition-all duration-300 flex items-center justify-center gap-2 transform hover:scale-[1.02] active:scale-[0.98]">
                    <span>Simpan Pesanan</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                </button>
            </div>
            
        </form>
        @endif
    </div>
</div>
