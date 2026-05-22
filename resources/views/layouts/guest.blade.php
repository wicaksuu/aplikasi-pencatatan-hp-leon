<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', config('app.name', 'Leon'))</title>
        <meta name="description" content="Leon — Aplikasi pencatatan pesanan handphone terintegrasi dari berbagai marketplace. Kelola penjualan, arsip, dan platform dalam satu dashboard premium.">
        <meta name="keywords" content="pencatatan hp, manajemen pesanan, marketplace, e-commerce, leon">
        <meta name="author" content="Leon">
        <meta name="robots" content="index, follow">
        <meta name="theme-color" content="#0f172a">

        <!-- PWA Support -->
        <link rel="manifest" href="/manifest.json">
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
        <meta name="apple-mobile-web-app-title" content="Leon">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        <!-- Canonical -->
        <link rel="canonical" href="{{ url()->current() }}">

        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

        <!-- Open Graph -->
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:title" content="{{ config('app.name', 'Leon') }}">
        <meta property="og:description" content="Aplikasi pencatatan pesanan handphone terintegrasi dari berbagai marketplace.">
        <meta property="og:site_name" content="{{ config('app.name', 'Leon') }}">

        <!-- Twitter Card -->
        <meta name="twitter:card" content="summary">
        <meta name="twitter:title" content="{{ config('app.name', 'Leon') }}">
        <meta name="twitter:description" content="Aplikasi pencatatan pesanan handphone terintegrasi dari berbagai marketplace.">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
        <style>
            .premium-bg {
                background: linear-gradient(-45deg, #0f172a, #020617, #1e1b4b, #000000);
                background-size: 400% 400%;
                animation: gradientBG 15s ease infinite;
            }
            @keyframes gradientBG {
                0% { background-position: 0% 50%; }
                50% { background-position: 100% 50%; }
                100% { background-position: 0% 50%; }
            }
            .orb-1 {
                position: fixed; top: 10%; left: 10%; width: 300px; height: 300px;
                background: radial-gradient(circle, rgba(124,58,237,0.2) 0%, rgba(0,0,0,0) 70%);
                border-radius: 50%; filter: blur(40px); z-index: 0;
                animation: float 6s ease-in-out infinite; pointer-events: none;
            }
            .orb-2 {
                position: fixed; bottom: 10%; right: 10%; width: 400px; height: 400px;
                background: radial-gradient(circle, rgba(56,189,248,0.15) 0%, rgba(0,0,0,0) 70%);
                border-radius: 50%; filter: blur(60px); z-index: 0;
                animation: float 8s ease-in-out infinite reverse; pointer-events: none;
            }
            @keyframes float {
                0% { transform: translateY(0px); }
                50% { transform: translateY(-30px); }
                100% { transform: translateY(0px); }
            }
            @keyframes scaleIn {
                0% { transform: scale(0); opacity: 0; }
                100% { transform: scale(1); opacity: 1; }
            }
            .animate-scaleIn {
                animation: scaleIn 0.25s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
            }
        </style>
    </head>
    <body class="antialiased min-h-screen premium-bg text-white relative overflow-x-hidden">
        <div class="orb-1"></div>
        <div class="orb-2"></div>

        <!-- Public Navbar -->
        <nav class="hidden lg:block fixed top-0 left-0 right-0 z-50 bg-black/20 backdrop-blur-xl border-b border-white/10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12">
                <div class="flex items-center justify-between h-16">
                    <a href="/" class="flex items-center gap-2 text-xl font-bold text-white tracking-tighter">
                        <div class="w-8 h-8 rounded-lg bg-gradient-to-tr from-violet-600 to-sky-400 flex items-center justify-center shadow-lg shadow-violet-500/30">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                        </div>
                        <span class="font-bold tracking-tight text-white">Le<span class="text-sky-400 font-light">on</span></span>
                    </a>
                    <div class="flex items-center gap-4">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-sm font-medium bg-white/10 hover:bg-white/20 text-white px-5 py-2 rounded-full border border-white/10 transition-all duration-300">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-medium text-white/70 hover:text-white transition-colors duration-200">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="text-sm font-medium bg-white/10 hover:bg-white/20 text-white px-5 py-2 rounded-full border border-white/10 transition-all duration-300">Register</a>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <div class="relative z-10 font-sans text-gray-100 antialiased pt-0 lg:pt-16 pb-12 lg:pb-0">
            {{ $slot }}
        </div>

        @guest
        <!-- Banner Instalasi PWA Premium (Mobile App-Like) -->
        <div x-data="{ 
                showInstallBanner: false, 
                deferredPrompt: null,
                init() {
                    window.addEventListener('beforeinstallprompt', (e) => {
                        // Mencegah browser menampilkan prompt default otomatis
                        e.preventDefault();
                        // Simpan event agar bisa dipicu nanti
                        this.deferredPrompt = e;
                        // Tampilkan banner kustom kita
                        this.showInstallBanner = true;
                    });
                    window.addEventListener('appinstalled', () => {
                        this.showInstallBanner = false;
                        this.deferredPrompt = null;
                    });
                },
                async installApp() {
                    if (!this.deferredPrompt) return;
                    // Tampilkan prompt instalasi browser
                    this.deferredPrompt.prompt();
                    // Tunggu pilihan user
                    const { outcome } = await this.deferredPrompt.userChoice;
                    if (outcome === 'accepted') {
                        console.log('User menerima instalasi PWA Leon');
                    }
                    this.showInstallBanner = false;
                    this.deferredPrompt = null;
                }
             }" 
             x-show="showInstallBanner"
             x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="translate-y-full opacity-0"
             x-transition:enter-end="translate-y-0 opacity-100"
             x-transition:leave="transition ease-in duration-200 transform"
             x-transition:leave-start="translate-y-0 opacity-100"
             x-transition:leave-end="translate-y-full opacity-0"
             class="fixed bottom-4 left-4 right-4 md:left-auto md:right-4 md:w-96 z-[9999] bg-slate-950/85 backdrop-blur-2xl border border-white/10 rounded-2xl p-4 shadow-2xl text-white no-select"
             style="display: none;">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 shrink-0 rounded-xl bg-gradient-to-tr from-violet-600 to-sky-400 flex items-center justify-center shadow-lg shadow-violet-500/20">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <h4 class="font-bold text-sm tracking-tight text-white leading-tight">Install Aplikasi Leon</h4>
                    <p class="text-[11px] text-gray-400 mt-0.5 leading-snug">Jadikan lebih praktis, buka langsung dari layar utama HP Anda!</p>
                </div>
            </div>
            <div class="flex items-center gap-2 mt-4">
                <button @click="showInstallBanner = false" class="flex-1 py-2 text-xs font-semibold text-gray-400 hover:text-white bg-white/5 hover:bg-white/10 rounded-xl border border-white/5 transition-all">Batal</button>
                <button @click="installApp()" class="flex-1 py-2 text-xs font-bold text-white bg-gradient-to-r from-violet-600 to-sky-500 hover:from-violet-500 hover:to-sky-400 rounded-xl shadow-md shadow-violet-600/10 transition-all btn-premium">Install</button>
            </div>
        </div>
        @endguest

        @livewireScripts
    </body>
</html>
