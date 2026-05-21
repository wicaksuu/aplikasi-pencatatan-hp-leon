<div>
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
