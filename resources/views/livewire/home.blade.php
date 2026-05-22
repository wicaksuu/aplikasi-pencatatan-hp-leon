<div>
    <!-- MOBILE APP SCREEN VIEW (Khusus Layar HP / Mobile-First App Dashboard) -->
    <div class="block lg:hidden px-4 pt-4 pb-8 space-y-6">
        <!-- Welcoming & Profile header -->
        <div class="flex items-center justify-between">
            <div>
                <span class="text-xs font-semibold text-sky-400 uppercase tracking-widest block">Aplikasi Leon</span>
                <h1 class="text-2xl font-bold text-white tracking-tight mt-0.5" x-data="{
                    getGreeting() {
                        const hour = new Date().getHours();
                        if (hour < 11) return 'Selamat Pagi 🌅';
                        if (hour < 15) return 'Selamat Siang ☀️';
                        if (hour < 19) return 'Selamat Sore 🌤️';
                        return 'Selamat Malam 🌙';
                    }
                }" x-text="getGreeting()"></h1>
            </div>
            <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-violet-600 to-sky-400 p-[1.5px] shadow-lg shadow-violet-500/20">
                <div class="w-full h-full rounded-full bg-slate-950 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-sky-300" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Premium Caching Banner (PWA status/tip) -->
        <div class="bg-gradient-to-r from-violet-600/10 to-sky-500/10 border border-white/10 rounded-2xl p-4 relative overflow-hidden backdrop-blur-md">
            <div class="absolute -right-8 -bottom-8 w-24 h-24 bg-sky-500/20 rounded-full blur-xl pointer-events-none"></div>
            <div class="flex items-start gap-3">
                <div class="w-8 h-8 rounded-lg bg-violet-500/20 text-violet-400 flex items-center justify-center shrink-0 mt-0.5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <div class="min-w-0">
                    <h3 class="text-sm font-bold text-white leading-tight">Pencatatan Instan Aktif</h3>
                    <p class="text-[11px] text-gray-400 mt-1 leading-relaxed">Kelola dan catat semua pesanan marketplace Anda dalam hitungan detik langsung dari genggaman.</p>
                </div>
            </div>
        </div>

        <!-- App Quick Stats (Kartu Statistik 2x2 Glassmorphic) -->
        <div>
            <h2 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Ringkasan Penjualan</h2>
            <div class="grid grid-cols-2 gap-3">
                <!-- Total Pesanan -->
                <div class="bg-white/[0.03] backdrop-blur-xl border border-white/10 rounded-2xl p-4 shadow-lg flex flex-col justify-between h-28 relative overflow-hidden">
                    <div class="absolute -right-4 -top-4 w-12 h-12 bg-violet-600/10 rounded-full blur-lg pointer-events-none"></div>
                    <div class="text-violet-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" /></svg>
                    </div>
                    <div>
                        <p class="text-2xl font-black text-white tracking-tight">{{ number_format($totalOrders, 0, ',', '.') }}</p>
                        <p class="text-[10px] text-gray-400 font-semibold uppercase tracking-wider mt-0.5">Total Pesanan</p>
                    </div>
                </div>

                <!-- Total Pendapatan -->
                <div class="bg-white/[0.03] backdrop-blur-xl border border-white/10 rounded-2xl p-4 shadow-lg flex flex-col justify-between h-28 relative overflow-hidden">
                    <div class="absolute -right-4 -top-4 w-12 h-12 bg-emerald-600/10 rounded-full blur-lg pointer-events-none"></div>
                    <div class="text-emerald-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <div>
                        <p class="text-base font-black text-white tracking-tight leading-none">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                        <p class="text-[10px] text-gray-400 font-semibold uppercase tracking-wider mt-1.5">Pendapatan</p>
                    </div>
                </div>

                <!-- Unit Terjual -->
                <div class="bg-white/[0.03] backdrop-blur-xl border border-white/10 rounded-2xl p-4 shadow-lg flex flex-col justify-between h-28 relative overflow-hidden">
                    <div class="absolute -right-4 -top-4 w-12 h-12 bg-sky-600/10 rounded-full blur-lg pointer-events-none"></div>
                    <div class="text-sky-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>
                    </div>
                    <div>
                        <p class="text-2xl font-black text-white tracking-tight">{{ number_format($totalItems, 0, ',', '.') }}</p>
                        <p class="text-[10px] text-gray-400 font-semibold uppercase tracking-wider mt-0.5">Unit Terjual</p>
                    </div>
                </div>

                <!-- Total Platform -->
                <div class="bg-white/[0.03] backdrop-blur-xl border border-white/10 rounded-2xl p-4 shadow-lg flex flex-col justify-between h-28 relative overflow-hidden">
                    <div class="absolute -right-4 -top-4 w-12 h-12 bg-amber-600/10 rounded-full blur-lg pointer-events-none"></div>
                    <div class="text-amber-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
                    </div>
                    <div>
                        <p class="text-2xl font-black text-white tracking-tight">{{ number_format($platforms, 0, ',', '.') }}</p>
                        <p class="text-[10px] text-gray-400 font-semibold uppercase tracking-wider mt-0.5">Platform</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions (Aksi Cepat Menu HP) -->
        <div>
            <h2 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Aksi Cepat</h2>
            <div class="grid grid-cols-2 gap-4">
                <!-- Aksi 1: Catat Pesanan -->
                <a href="{{ route('input') }}" class="flex flex-col items-center justify-center p-5 bg-gradient-to-br from-violet-600 to-indigo-700 border border-violet-500/20 rounded-2xl text-center shadow-lg shadow-violet-600/10 hover:scale-105 active:scale-95 transition-all btn-premium no-select">
                    <div class="w-11 h-11 rounded-full bg-white/10 flex items-center justify-center text-white mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                    </div>
                    <span class="text-xs font-bold text-white block">Catat Pesanan</span>
                </a>

                <!-- Aksi 2: Dashboard Admin -->
                <a href="{{ route('dashboard') }}" class="flex flex-col items-center justify-center p-5 bg-white/[0.03] backdrop-blur-md border border-white/10 rounded-2xl text-center shadow-md hover:scale-105 active:scale-95 transition-all btn-premium no-select">
                    <div class="w-11 h-11 rounded-full bg-white/5 flex items-center justify-center text-sky-400 mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 002 2h2a2 2 0 002-2z" /></svg>
                    </div>
                    <span class="text-xs font-bold text-gray-200 block">Dashboard Admin</span>
                </a>

                <!-- Aksi 3: Kelola Platform -->
                <a href="{{ route('admin.platforms') }}" class="flex flex-col items-center justify-center p-5 bg-white/[0.03] backdrop-blur-md border border-white/10 rounded-2xl text-center shadow-md hover:scale-105 active:scale-95 transition-all btn-premium no-select">
                    <div class="w-11 h-11 rounded-full bg-white/5 flex items-center justify-center text-amber-400 mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" /></svg>
                    </div>
                    <span class="text-xs font-bold text-gray-200 block">Kelola Platform</span>
                </a>

                <!-- Aksi 4: Lihat Arsip -->
                <a href="{{ route('admin.archives') }}" class="flex flex-col items-center justify-center p-5 bg-white/[0.03] backdrop-blur-md border border-white/10 rounded-2xl text-center shadow-md hover:scale-105 active:scale-95 transition-all btn-premium no-select">
                    <div class="w-11 h-11 rounded-full bg-white/5 flex items-center justify-center text-emerald-400 mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" /></svg>
                    </div>
                    <span class="text-xs font-bold text-gray-200 block">Arsip Pesanan</span>
                </a>
            </div>
        </div>

        <!-- Decorative Info Card (Buku Panduan Kecil PWA) -->
        <div class="bg-black/25 backdrop-blur-md border border-white/5 rounded-2xl p-5 text-center">
            <p class="text-xs text-gray-500 font-medium">Sistem Pencatatan Handphone &copy; {{ date('Y') }} Leon</p>
        </div>
    </div>

    <!-- DESKTOP COMMERCE VIEW (Halaman Landing Page Web Biasa di Layar Lebar) -->
    <div class="hidden lg:block">
        <!-- Hero Section -->
        <div class="relative overflow-hidden">
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[500px] bg-violet-600/20 rounded-full blur-[120px] pointer-events-none"></div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-24 sm:pt-32 pb-20 sm:pb-28 relative">
                <div class="text-center max-w-4xl mx-auto">
                    <div class="inline-flex items-center gap-2 bg-white/5 border border-white/10 rounded-full px-4 py-1.5 mb-8">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        <span class="text-sm text-gray-300">Sistem Pencatatan Handphone Terintegrasi</span>
                    </div>
                    <h1 class="text-5xl sm:text-7xl font-bold text-white tracking-tight mb-8 leading-tight">
                        Kelola Penjualan<br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-sky-400 via-violet-400 to-emerald-400">Lebih Cepat & Tepat</span>
                    </h1>
                    <p class="text-lg sm:text-xl text-gray-400 max-w-2xl mx-auto mb-12 leading-relaxed">
                        Leon membantu Anda mencatat pesanan handphone dari berbagai marketplace dalam satu sistem. Pantau stok, arsip, dan analisa penjualan secara real-time.
                    </p>
                    <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                        <a href="{{ route('input') }}" class="w-full sm:w-auto px-8 py-4 bg-gradient-to-r from-violet-600 to-sky-500 hover:from-violet-500 hover:to-sky-400 text-white font-bold rounded-xl shadow-lg shadow-violet-500/25 transition-all transform hover:scale-105 flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                            Input Pesanan
                        </a>
                        <a href="{{ route('login') }}" class="w-full sm:w-auto px-8 py-4 bg-white/5 hover:bg-white/10 text-white font-semibold rounded-xl border border-white/10 transition-all flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" /></svg>
                            Dashboard Admin
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Strip -->
        <div class="border-y border-white/10 bg-black/20 backdrop-blur-md">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-8">
                    <div class="text-center">
                        <p class="text-3xl sm:text-4xl font-bold text-white">{{ number_format($totalOrders, 0, ',', '.') }}</p>
                        <p class="text-sm text-gray-400 mt-1">Total Pesanan</p>
                    </div>
                    <div class="text-center">
                        <p class="text-3xl sm:text-4xl font-bold text-white">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                        <p class="text-sm text-gray-400 mt-1">Total Pendapatan</p>
                    </div>
                    <div class="text-center">
                        <p class="text-3xl sm:text-4xl font-bold text-white">{{ number_format($totalItems, 0, ',', '.') }}</p>
                        <p class="text-sm text-gray-400 mt-1">Unit Terjual</p>
                    </div>
                    <div class="text-center">
                        <p class="text-3xl sm:text-4xl font-bold text-white">{{ number_format($platforms, 0, ',', '.') }}</p>
                        <p class="text-sm text-gray-400 mt-1">Platform</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-4xl font-bold text-white tracking-tight mb-4">Mengapa Menggunakan Leon?</h2>
                <p class="text-gray-400 max-w-2xl mx-auto">Semua yang Anda butuhkan untuk mengelola pesanan handphone dalam satu platform.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-black/20 backdrop-blur-md border border-white/10 rounded-2xl p-8 hover:bg-white/5 hover:border-white/20 transition-all group">
                    <div class="w-12 h-12 rounded-xl bg-sky-500/10 text-sky-400 flex items-center justify-center mb-6 group-hover:bg-sky-500/20 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Input Cepat</h3>
                    <p class="text-gray-400 leading-relaxed">Catat pesanan dari berbagai marketplace hanya dalam hitungan detik. Form yang simpel dan responsif.</p>
                </div>

                <div class="bg-black/20 backdrop-blur-md border border-white/10 rounded-2xl p-8 hover:bg-white/5 hover:border-white/20 transition-all group">
                    <div class="w-12 h-12 rounded-xl bg-violet-500/10 text-violet-400 flex items-center justify-center mb-6 group-hover:bg-violet-500/20 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" /></svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Arsip Terorganisir</h3>
                    <p class="text-gray-400 leading-relaxed">Kelompokkan pesanan ke dalam arsip sesuai kebutuhan. Mudah dicari dan tidak berantakan.</p>
                </div>

                <div class="bg-black/20 backdrop-blur-md border border-white/10 rounded-2xl p-8 hover:bg-white/5 hover:border-white/20 transition-all group">
                    <div class="w-12 h-12 rounded-xl bg-emerald-500/10 text-emerald-400 flex items-center justify-center mb-6 group-hover:bg-emerald-500/20 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 002 2h2a2 2 0 002-2z" /></svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Analisa Lengkap</h3>
                    <p class="text-gray-400 leading-relaxed">Dashboard dengan statistik pendapatan, performa platform, dan barang terlaris secara real-time.</p>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-24">
            <div class="relative bg-gradient-to-r from-violet-600/20 to-sky-500/20 border border-white/10 rounded-3xl p-12 sm:p-16 text-center overflow-hidden">
                <div class="absolute top-0 right-0 w-64 h-64 bg-violet-500/20 rounded-full blur-[80px] pointer-events-none"></div>
                <div class="absolute bottom-0 left-0 w-64 h-64 bg-sky-500/20 rounded-full blur-[80px] pointer-events-none"></div>
                <div class="relative z-10">
                    <h2 class="text-3xl sm:text-4xl font-bold text-white tracking-tight mb-4">Siap Mencatat Pesanan?</h2>
                    <p class="text-gray-400 max-w-xl mx-auto mb-8">Mulai gunakan Leon sekarang untuk mengelola penjualan handphone Anda dengan lebih efisien.</p>
                    <a href="{{ route('input') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-gradient-to-r from-violet-600 to-sky-500 hover:from-violet-500 hover:to-sky-400 text-white font-bold rounded-xl shadow-lg shadow-violet-500/25 transition-all transform hover:scale-105">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                        Input Pesanan Sekarang
                    </a>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="border-t border-white/10 bg-black/20 backdrop-blur-md">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="flex items-center gap-2 text-white font-bold">
                        <div class="w-6 h-6 rounded bg-gradient-to-tr from-violet-600 to-sky-400 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                        </div>
                        <span class="font-bold tracking-tight text-white">Le<span class="text-sky-400 font-light">on</span></span>
                    </div>
                    <p class="text-sm text-gray-500">Sistem Pencatatan Handphone &copy; {{ date('Y') }}</p>
                </div>
            </div>
        </footer>
    </div>
</div>
