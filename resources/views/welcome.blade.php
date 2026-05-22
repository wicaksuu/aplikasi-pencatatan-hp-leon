<x-guest-layout>
    <!-- Hero Section -->
    <div class="min-h-screen flex items-center justify-center relative z-10 pt-0 lg:pt-16 pb-8 lg:pb-12 w-full">
        <div class="container mx-auto px-0 lg:px-12 flex flex-col lg:flex-row items-center justify-between gap-8 lg:gap-16 h-full w-full">

            <!-- Left Side Text (Hidden on Mobile) -->
            <div class="hidden lg:flex flex-col text-left max-w-2xl lg:w-1/2">
                <!-- Badge -->
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/5 border border-white/10 backdrop-blur-md mb-8 w-fit">
                    <span class="flex h-2 w-2 relative">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-sky-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-sky-500"></span>
                    </span>
                    <span class="text-sm text-sky-200 font-medium tracking-wide uppercase">Sistem Pencatatan Real-time</span>
                </div>

                <!-- Heading -->
                <h1 class="text-5xl xl:text-7xl font-bold mb-6 leading-tight tracking-tight text-white">
                    Kelola Pesanan dengan <span class="text-transparent bg-clip-text bg-gradient-to-r from-violet-400 to-sky-300">Presisi.</span>
                </h1>

                <!-- Description -->
                <p class="text-lg xl:text-xl text-gray-400 mb-10 leading-relaxed font-light max-w-xl">
                    Input data pencatatan barang secara instan tanpa hambatan. Sinkronisasi otomatis ke dashboard admin tanpa perlu membuat akun.
                </p>

                <!-- Feature badges -->
                <div class="flex items-center gap-6">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-white/5 border border-white/10 flex items-center justify-center backdrop-blur-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                        </div>
                        <div class="text-left">
                            <h4 class="text-white font-semibold">100% Aman</h4>
                            <p class="text-xs text-gray-400">Enkripsi End-to-end</p>
                        </div>
                    </div>
                    <div class="w-px h-10 bg-white/10"></div>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-white/5 border border-white/10 flex items-center justify-center backdrop-blur-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-sky-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                        </div>
                        <div class="text-left">
                            <h4 class="text-white font-semibold">Sangat Cepat</h4>
                            <p class="text-xs text-gray-400">Sinkronisasi Real-time</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side Form (Livewire) -->
            <div class="w-full lg:w-1/2 flex justify-center lg:justify-end">
                <div class="w-full max-w-md">
                    @livewire('public-order-form')
                </div>
            </div>

        </div>
    </div>
</x-guest-layout>
