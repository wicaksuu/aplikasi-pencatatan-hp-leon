<x-guest-layout>
    <!-- Floating Back Button (Mobile & Desktop App-Like Nav) -->
    <a href="/" class="fixed top-5 left-5 z-50 w-11 h-11 bg-white/5 backdrop-blur-xl border border-white/10 rounded-full flex items-center justify-center text-white hover:bg-white/10 hover:border-white/20 active:scale-95 transition-all shadow-lg shadow-black/35" title="Kembali ke Beranda">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
        </svg>
    </a>

    <!-- Additional Ambient Glowing Auroras -->
    <div class="fixed top-1/4 left-1/4 w-[350px] h-[350px] bg-violet-600/10 rounded-full filter blur-[100px] animate-pulse pointer-events-none z-0"></div>
    <div class="fixed bottom-1/4 right-1/4 w-[400px] h-[400px] bg-sky-500/10 rounded-full filter blur-[120px] animate-pulse pointer-events-none z-0"></div>

    <div class="min-h-screen flex items-center justify-center relative z-10 py-4 lg:py-0 px-4 md:px-8 -mb-12 lg:mb-0">
        <div class="w-full max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-16 items-center">
            
            <!-- SISI KIRI: Form Login (Glassmorphism Premium) -->
            <div class="lg:col-span-6 flex items-center justify-center w-full">
                <div class="relative group w-full max-w-md">
                    <!-- Glowing border effect for the card -->
                    <div class="absolute -inset-1 bg-gradient-to-r from-violet-600 to-sky-500 rounded-2xl blur opacity-25 group-hover:opacity-45 transition duration-1000 group-hover:duration-200 pointer-events-none"></div>
                    
                    <div class="relative bg-black/40 backdrop-blur-2xl border border-white/10 p-8 sm:p-10 rounded-2xl shadow-[0_20px_50px_rgba(0,0,0,0.5)] w-full">
                        
                        <!-- Header Form -->
                        <div class="mb-8 text-center sm:text-left">
                            <!-- Logo Leon (Tampil di mobile, sembunyi di desktop) -->
                            <div class="flex items-center justify-center sm:justify-start gap-2.5 mb-4 lg:hidden">
                                <div class="w-8 h-8 rounded-lg bg-gradient-to-tr from-violet-600 to-sky-400 flex items-center justify-center shadow-lg shadow-violet-500/25">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                </div>
                                <span class="text-xl font-bold tracking-tight text-white">Le<span class="text-sky-400 font-light">on</span></span>
                            </div>
                            
                            <h2 class="text-3xl font-extrabold text-white tracking-tight leading-tight">Selamat Datang</h2>
                            <p class="text-gray-400 text-xs mt-2 font-medium leading-relaxed">Silakan masuk dengan akun Anda untuk mengelola seluruh aktivitas pencatatan pesanan.</p>
                        </div>

                        <!-- Error Validasi & Status -->
                        <x-validation-errors class="mb-6 text-red-400 bg-red-500/10 border border-red-500/20 p-4 rounded-xl text-xs font-semibold leading-relaxed animate-pulse" />

                        @session('status')
                            <div class="mb-6 font-semibold text-xs text-emerald-400 bg-emerald-500/10 border border-emerald-500/20 p-4 rounded-xl leading-relaxed">
                                {{ $value }}
                            </div>
                        @endsession

                        <!-- Form Autentikasi -->
                        <form method="POST" action="{{ route('login') }}" class="space-y-5.5">
                            @csrf

                            <!-- Username -->
                            <div class="space-y-1.5">
                                <label for="username" class="text-[11px] font-bold text-gray-300 uppercase tracking-wider">Username</label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-500 group-focus-within:text-violet-400 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                    <input id="username" type="text" name="username" :value="old('username')" required autofocus autocomplete="username" class="w-full bg-white/[0.04] border border-white/10 rounded-xl pl-11 pr-4 py-3.5 text-sm text-white placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-violet-500/40 focus:border-violet-500/50 transition-all font-medium" placeholder="Masukkan username Anda" />
                                </div>
                            </div>

                            <!-- Password (dengan Alpine Toggler) -->
                            <div class="space-y-1.5" x-data="{ showPassword: false }">
                                <label for="password" class="text-[11px] font-bold text-gray-300 uppercase tracking-wider">Kata Sandi</label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-500 group-focus-within:text-violet-400 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                        </svg>
                                    </div>
                                    <input id="password" :type="showPassword ? 'text' : 'password'" name="password" required autocomplete="current-password" class="w-full bg-white/[0.04] border border-white/10 rounded-xl pl-11 pr-12 py-3.5 text-sm text-white placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-violet-500/40 focus:border-violet-500/50 transition-all font-medium" placeholder="••••••••" />
                                    <!-- Password visibility toggler -->
                                    <button type="button" @click="showPassword = !showPassword" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-gray-500 hover:text-white transition-colors focus:outline-none">
                                        <!-- Eye Icon (hidden) -->
                                        <svg x-show="!showPassword" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        <!-- Eye Off Icon (shown) -->
                                        <svg x-show="showPassword" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <!-- Ingat Saya & Forgot Password -->
                            <div class="flex items-center justify-between pt-1">
                                <label for="remember_me" class="flex items-center cursor-pointer group select-none">
                                    <div class="relative flex items-center justify-center">
                                        <input type="checkbox" id="remember_me" name="remember" class="peer sr-only" />
                                        <div class="w-5 h-5 bg-white/5 border border-white/20 rounded peer-checked:bg-violet-600 peer-checked:border-violet-600 transition-all flex items-center justify-center shadow-inner">
                                            <svg class="w-3.5 h-3.5 text-white opacity-0 peer-checked:opacity-100 transition-opacity" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                            </svg>
                                        </div>
                                    </div>
                                    <span class="ms-3 text-xs font-semibold text-gray-400 group-hover:text-gray-300 transition-colors">Ingat saya</span>
                                </label>
                            </div>

                            <!-- Tombol Masuk -->
                            <div class="pt-3">
                                <button type="submit" class="w-full py-3.5 px-4 bg-gradient-to-r from-violet-600 to-sky-500 hover:from-violet-500 hover:to-sky-400 text-white font-bold rounded-xl shadow-[0_0_20px_rgba(124,58,237,0.25)] hover:shadow-[0_0_30px_rgba(124,58,237,0.45)] active:scale-[0.98] transition-all duration-300 flex items-center justify-center gap-2 text-sm tracking-wide">
                                    <span>Masuk ke Dasbor</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <!-- SISI KANAN: Dekorasi Visual Dasbor Leon (Hanya Tampil di Desktop) -->
            <div class="lg:col-span-6 hidden lg:flex flex-col justify-center w-full relative">
                <!-- Glowing element in center behind phone mock-up -->
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-violet-600/15 rounded-full blur-[90px] pointer-events-none animate-pulse"></div>

                <div class="relative w-full max-w-lg mx-auto text-center space-y-7 z-10">
                    <!-- Multi Platform pill -->
                    <div class="inline-flex items-center gap-3 bg-white/[0.03] backdrop-blur-xl border border-white/10 px-4 py-2 rounded-full shadow-lg shadow-black/25">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-ping"></span>
                        <span class="text-[10px] font-extrabold text-gray-200 tracking-widest uppercase">LEON MULTI-PLATFORM ENGINE</span>
                    </div>

                    <div class="space-y-3">
                        <h3 class="text-4xl font-extrabold text-white tracking-tight leading-tight">Satu Dasbor untuk Semua Marketplace</h3>
                        <p class="text-gray-400 text-sm leading-relaxed max-w-md mx-auto">Pantau dan kelola pesanan penjualan handphone Anda secara real-time dari Shopee, Tokopedia, Lazada, TikTok, dan WhatsApp dalam satu dasbor premium terintegrasi.</p>
                    </div>

                    <!-- CSS-Based Handphone Mockup (Futuristik & Premium) -->
                    <div class="relative w-60 mx-auto border-[6px] border-slate-800 bg-slate-950 rounded-[2.5rem] p-3.5 shadow-2xl shadow-black/80 overflow-hidden aspect-[9/18]">
                        <!-- Dynamic Notch speaker -->
                        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-28 h-4 bg-slate-800 rounded-b-xl z-20"></div>

                        <!-- Screen Content -->
                        <div class="h-full bg-gradient-to-b from-slate-900 to-black rounded-[2rem] p-3 text-left relative overflow-y-auto no-scrollbar">
                            <!-- Inner Nav -->
                            <div class="flex items-center justify-between border-b border-white/5 pb-2.5 mb-3 pt-2">
                                <span class="text-[9px] font-bold text-white tracking-wider flex items-center gap-1.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-violet-500 animate-pulse"></span> Leon Mobile
                                </span>
                                <span class="text-[7px] text-emerald-400 font-extrabold uppercase tracking-widest bg-emerald-500/10 border border-emerald-500/20 px-2 py-0.5 rounded-full">Aktif</span>
                            </div>

                            <!-- Mock Data Panel -->
                            <div class="space-y-3">
                                <!-- Order List Card (Mini mockup) -->
                                <div class="p-2.5 bg-white/5 border border-white/10 rounded-xl space-y-2">
                                    <div class="flex justify-between items-center text-[7px] text-gray-400">
                                        <span>Pesanan Baru #490</span>
                                        <span class="text-[8px] font-bold text-sky-400">12:35</span>
                                    </div>
                                    <div class="space-y-1">
                                        <p class="font-bold text-white text-[9px]">Wicaksono</p>
                                        <p class="text-[7.5px] text-gray-300">Xiaomi Redmi Note 13 Pro 5G</p>
                                    </div>
                                    <div class="flex justify-between items-center text-[8px] border-t border-white/5 pt-1.5">
                                        <span class="text-orange-400 font-bold uppercase text-[7px] bg-orange-500/10 px-1 py-0.5 rounded">Shopee</span>
                                        <span class="text-emerald-400 font-bold">Rp 3.899.000</span>
                                    </div>
                                </div>

                                <!-- Statistics Visual Mini Card -->
                                <div class="p-2.5 bg-violet-500/5 border border-violet-500/10 rounded-xl space-y-1.5">
                                    <div class="flex justify-between items-center text-[8px] font-bold text-violet-400">
                                        <span>Total Pendapatan</span>
                                        <span class="text-[7px] font-medium text-gray-400">Hari ini</span>
                                    </div>
                                    <p class="text-xs font-extrabold text-emerald-400">Rp 12.850.000</p>
                                    <div class="w-full bg-white/5 rounded-full h-1 overflow-hidden">
                                        <div class="bg-gradient-to-r from-violet-500 to-sky-400 h-full rounded-full" style="width: 75%"></div>
                                    </div>
                                </div>

                                <!-- Mini grids platforms icons in mobile screen -->
                                <div class="grid grid-cols-3 gap-1.5 pt-1 text-[7.5px]">
                                    <div class="bg-orange-500/10 border border-orange-500/25 p-1 rounded-lg text-center text-orange-400 font-extrabold">Shopee</div>
                                    <div class="bg-emerald-500/10 border border-emerald-500/25 p-1 rounded-lg text-center text-emerald-400 font-extrabold">Tokopedia</div>
                                    <div class="bg-sky-500/10 border border-sky-500/25 p-1 rounded-lg text-center text-sky-400 font-extrabold">Lazada</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-guest-layout>
