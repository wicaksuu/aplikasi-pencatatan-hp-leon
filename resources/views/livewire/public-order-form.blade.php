<div class="relative group w-full">
    <!-- Glowing backdrop effect for the card -->
    <div class="absolute -inset-1 bg-gradient-to-r from-violet-600/40 to-sky-500/40 rounded-2xl blur-lg opacity-0 lg:opacity-25 lg:group-hover:opacity-40 transition duration-1000 group-hover:duration-200"></div>
    
    <div class="relative bg-transparent lg:bg-black/40 backdrop-blur-none lg:backdrop-blur-xl border-0 lg:border border-white/10 p-0 sm:p-8 rounded-none lg:rounded-2xl shadow-none lg:shadow-2xl w-full">
        <!-- Mobile PWA Header & Title (Fixed di HP, Mentok Kanan-Kiri-Atas) -->
        <div class="block lg:hidden fixed top-0 left-0 right-0 z-50 bg-white/[0.02] backdrop-blur-2xl px-5 pt-safe-top pt-4 pb-4 border-b border-white/5">
            <div class="flex items-center justify-between mb-4">
                <!-- Logo & Nama Aplikasi -->
                <div class="flex items-center gap-2.5">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-violet-600 to-sky-400 flex items-center justify-center shadow-lg shadow-violet-500/30">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5.5 w-5.5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-lg font-black tracking-tight text-white leading-none">LEON</h1>
                        <div class="flex items-center gap-1.5 mt-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                            <span class="text-[10px] text-emerald-400 font-bold uppercase tracking-wider">Sinkronisasi Aktif</span>
                        </div>
                    </div>
                </div>
                
                <!-- Tombol Gembok Admin (Login) -->
                <a href="{{ route('login') }}" class="w-9 h-9 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-gray-400 hover:text-white active:scale-90 transition-all duration-200 shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </a>
            </div>
            
            <!-- Mobile Section Title -->
            <div>
                <h2 class="text-xl font-bold text-white tracking-tight">Catat Pesanan HP</h2>
                <p class="text-xs text-gray-400 mt-0.5">Masukkan detail pesanan pelanggan dengan teliti.</p>
            </div>
        </div>

        <!-- Pembungkus Konten Form dengan Padding Kompensasi Header Fixed di Mobile -->
        <div class="pt-[calc(9.5rem+env(safe-area-inset-top))] lg:pt-0 px-5 lg:px-0">
            <h2 class="hidden lg:block text-2xl font-bold mb-6 text-white">Input Pesanan Baru</h2>
            
            @if (session()->has('message'))
                <div class="mb-6">
                    <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 px-4 py-3 rounded-xl flex items-center gap-3 backdrop-blur-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <span class="text-sm font-medium">{{ session('message') }}</span>
                    </div>
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
        <form wire:submit.prevent="submit" class="space-y-6">
            
            <!-- Nama Barang -->
            <div class="space-y-2 relative" x-data="{ open: false }" @click.outside="open = false">
                <label class="text-xs font-bold text-gray-400 uppercase tracking-wider block">Nama Barang</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                        <!-- Ikon HP / Gadget -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-colors duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <input type="text" 
                        wire:model.live.debounce.300ms="nama_barang" 
                        wire:keyup="searchBarang"
                        @focus="open = true; $el.parentElement.querySelector('svg').classList.add('text-violet-400')"
                        @blur="$el.parentElement.querySelector('svg').classList.remove('text-violet-400')"
                        @input="open = true"
                        placeholder="Contoh: iPhone 15 Pro Max" 
                        autocomplete="off"
                        autocorrect="off"
                        autocapitalize="words"
                        spellcheck="false"
                        class="w-full bg-white/5 border border-white/10 rounded-2xl pl-12 pr-4 py-3.5 text-white placeholder-gray-500 focus:outline-none focus:ring-4 focus:ring-violet-500/20 focus:border-violet-500 focus:bg-white/[0.08] transition-all duration-300 btn-premium text-sm font-medium" />
                </div>
                
                <!-- Autocomplete Suggestions Dropdown -->
                @if(count($suggestions) > 0)
                <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                    class="absolute z-50 w-full mt-2 bg-[#090d16]/95 border border-white/10 rounded-2xl shadow-2xl shadow-black/80 overflow-hidden backdrop-blur-2xl">
                    @foreach($suggestions as $suggestion)
                        <button type="button"
                            wire:click="selectBarang('{{ addslashes($suggestion) }}')"
                            @click="open = false"
                            class="w-full text-left px-5 py-3.5 text-sm text-gray-300 hover:bg-violet-500/20 hover:text-white transition-colors duration-150 flex items-center gap-3 border-b border-white/5 last:border-b-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                            <span class="font-medium">{{ $suggestion }}</span>
                        </button>
                    @endforeach
                </div>
                @endif

                @error('nama_barang') <span class="text-red-400 text-xs font-semibold block mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- No Order & Nomor VA -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <!-- No Order -->
                <div class="space-y-2">
                    <label class="text-xs font-bold text-gray-400 uppercase tracking-wider block">No Order</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                            <!-- Ikon Tag / Nota -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-colors duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <input type="text" 
                            wire:model="no_order" 
                            @focus="$el.parentElement.querySelector('svg').classList.add('text-violet-400')"
                            @blur="$el.parentElement.querySelector('svg').classList.remove('text-violet-400')"
                            placeholder="INV-001..." 
                            autocorrect="off"
                            autocapitalize="characters"
                            spellcheck="false"
                            class="w-full bg-white/5 border border-white/10 rounded-2xl pl-12 pr-4 py-3.5 text-white placeholder-gray-500 focus:outline-none focus:ring-4 focus:ring-violet-500/20 focus:border-violet-500 focus:bg-white/[0.08] transition-all duration-300 btn-premium text-sm font-medium" />
                    </div>
                    @error('no_order') <span class="text-red-400 text-xs font-semibold block mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Nomor VA -->
                <div class="space-y-2">
                    <label class="text-xs font-bold text-gray-400 uppercase tracking-wider block">Nomor VA (Opsional)</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                            <!-- Ikon Kartu VA -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-colors duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                            </svg>
                        </div>
                        <input type="text" 
                            wire:model="nomor_va" 
                            @focus="$el.parentElement.querySelector('svg').classList.add('text-violet-400')"
                            @blur="$el.parentElement.querySelector('svg').classList.remove('text-violet-400')"
                            placeholder="880123..." 
                            inputmode="numeric"
                            pattern="[0-9]*"
                            class="w-full bg-white/5 border border-white/10 rounded-2xl pl-12 pr-4 py-3.5 text-white placeholder-gray-500 focus:outline-none focus:ring-4 focus:ring-violet-500/20 focus:border-violet-500 focus:bg-white/[0.08] transition-all duration-300 btn-premium text-sm font-medium" />
                    </div>
                    @error('nomor_va') <span class="text-red-400 text-xs font-semibold block mt-1">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Quantity & Harga -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <!-- Quantity -->
                <div class="space-y-2">
                    <label class="text-xs font-bold text-gray-400 uppercase tracking-wider block">Quantity (Unit)</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                            <!-- Ikon Jumlah -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-colors duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
                            </svg>
                        </div>
                        <input type="number" 
                            wire:model="qty" 
                            @focus="$el.parentElement.querySelector('svg').classList.add('text-violet-400')"
                            @blur="$el.parentElement.querySelector('svg').classList.remove('text-violet-400')"
                            min="1" 
                            inputmode="numeric"
                            pattern="[0-9]*"
                            class="w-full bg-white/5 border border-white/10 rounded-2xl pl-12 pr-4 py-3.5 text-white placeholder-gray-500 focus:outline-none focus:ring-4 focus:ring-violet-500/20 focus:border-violet-500 focus:bg-white/[0.08] transition-all duration-300 btn-premium text-sm font-medium" />
                    </div>
                    @error('qty') <span class="text-red-400 text-xs font-semibold block mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Harga -->
                <div class="space-y-2" x-data="{
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
                    <label class="text-xs font-bold text-gray-400 uppercase tracking-wider block">Harga Jual</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 font-semibold text-sm">
                            <span>Rp</span>
                        </div>
                        <input type="text" 
                            inputmode="numeric" 
                            x-model="formatted" 
                            @input="formatCurrency($event)" 
                            @focus="$el.parentElement.querySelector('span').classList.add('text-violet-400')"
                            @blur="$el.parentElement.querySelector('span').classList.remove('text-violet-400')"
                            placeholder="0" 
                            class="w-full bg-white/5 border border-white/10 rounded-2xl pl-12 pr-4 py-3.5 text-white placeholder-gray-500 focus:outline-none focus:ring-4 focus:ring-violet-500/20 focus:border-violet-500 focus:bg-white/[0.08] transition-all duration-300 btn-premium text-sm font-medium" />
                    </div>
                    @error('harga') <span class="text-red-400 text-xs font-semibold block mt-1">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Platform -->
            <div class="space-y-2">
                <label class="text-xs font-bold text-gray-400 uppercase tracking-wider block">Platform E-Commerce</label>
                
                <!-- Grid Platform Selektor Kustom Ramping & Hemat Ruang -->
                <div class="grid grid-cols-3 lg:grid-cols-4 gap-2.5">
                    @foreach($platformsData as $plat)
                        @php
                            $isSelected = $platform === $plat['name'];
                            $color = $plat['color'] ?? '#7c3aed';
                            $shadowStyle = $isSelected ? "box-shadow: 0 0 15px {$color}30; border-color: {$color};" : "";
                            $bgStyle = $isSelected ? "background-color: {$color}10;" : "";
                        @endphp
                        <button type="button"
                            wire:click="$set('platform', '{{ $plat['name'] }}')"
                            class="relative rounded-xl border py-2 px-2 flex flex-row items-center gap-1.5 transition-all duration-300 backdrop-blur-md active:scale-95 group text-left w-full
                                {{ $isSelected ? 'text-white' : 'bg-white/5 border-white/10 hover:border-white/20 hover:-translate-y-0.5 text-gray-400 hover:text-white' }}"
                            style="{{ $shadowStyle }} {{ $bgStyle }}">
                            
                            <!-- Ikon Platform Mungil Kustom -->
                            <div class="w-7 h-7 rounded-lg flex items-center justify-center shrink-0 transition-all duration-300"
                                style="background-color: {{ $color }}20; color: {{ $color }};">
                                @if($plat['name'] === 'Shopee')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                    </svg>
                                @elseif($plat['name'] === 'Tokopedia')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                @elseif($plat['name'] === 'TikTok Shop')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                                    </svg>
                                @elseif($plat['name'] === 'WhatsApp')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                    </svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                @endif
                            </div>

                            <!-- Label Platform Kompak Truncate -->
                            <span class="text-[11px] font-bold truncate tracking-tight transition-colors duration-300">{{ $plat['name'] }}</span>

                            <!-- Centang Mikro Aktif -->
                            @if($isSelected)
                                <div class="absolute -top-1 -right-1 w-4 h-4 rounded-full flex items-center justify-center text-white shadow-md animate-scaleIn"
                                    style="background-color: {{ $color }};">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-2.5 w-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                            @endif
                        </button>
                    @endforeach
                </div>
                
                @error('platform') <span class="text-red-400 text-xs font-semibold block mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- Submit Button -->
            <div class="pt-4 pb-12 lg:pb-0">
                <button type="submit" class="w-full py-4 px-4 bg-gradient-to-r from-violet-600 to-sky-500 hover:from-violet-500 hover:to-sky-400 text-white font-bold rounded-2xl shadow-[0_0_20px_rgba(124,58,237,0.3)] hover:shadow-[0_0_30px_rgba(124,58,237,0.5)] transition-all duration-300 flex items-center justify-center gap-2 transform active:scale-[0.97] btn-premium">
                    <span>Simpan Pesanan</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                </button>
            </div>
            
        </form>
        @endif
        </div>
    </div>
</div>

