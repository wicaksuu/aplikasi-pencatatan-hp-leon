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
            details > summary {
                list-style: none;
            }
            details > summary::-webkit-details-marker {
                display: none;
            }
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
        </style>
    </head>
    <body class="font-sans antialiased premium-bg text-white min-h-screen relative overflow-x-hidden">
        <div class="orb-1"></div>
        <div class="orb-2"></div>
        
        <x-banner />

        <div class="drawer lg:drawer-open">
            <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
            <div class="drawer-content flex flex-col items-center justify-start pb-20 lg:pb-0">
                
                <!-- Fixed Logout Button -->
                <div class="fixed top-4 right-4 z-50">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="btn btn-circle btn-sm bg-black/40 backdrop-blur-md border border-white/10 text-gray-400 hover:text-red-400 hover:bg-red-500/20 hover:border-red-500/30 transition-all shadow-lg" title="Keluar">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                        </a>
                    </form>
                </div>
                
                <!-- Navbar on Mobile -->
                <div class="w-full navbar bg-black/40 backdrop-blur-xl border-b border-white/10 lg:hidden shadow-sm sticky top-0 z-40">
                    <div class="flex-none hidden">
                        <label for="my-drawer-2" class="btn btn-square btn-ghost drawer-button text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-6 h-6 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                        </label>
                    </div>
                    <div class="flex-1">
                        <a class="btn btn-ghost normal-case text-xl text-white font-bold flex items-center gap-2">
                            <div class="w-6 h-6 rounded bg-gradient-to-tr from-violet-600 to-sky-400 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                            </div>
                            <span class="font-bold tracking-tight text-white">Le<span class="text-sky-400 font-light">on</span></span>
                        </a>
                    </div>
                </div>

                <!-- Page Heading (Desktop) -->
                @if (isset($header))
                    <header class="w-full bg-black/20 backdrop-blur-md border-b border-white/10 hidden lg:block">
                        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 text-white">
                            {{ $header }}
                        </div>
                    </header>
                @endif

                <!-- Page Content -->
                <main class="w-full p-4 lg:p-8 max-w-7xl mx-auto">
                    {{ $slot }}
                </main>
            
            </div> 
            
            <!-- Sidebar Drawer (Desktop) -->
            <div class="drawer-side z-50">
                <label for="my-drawer-2" aria-label="close sidebar" class="drawer-overlay"></label> 
                <div class="flex flex-col p-4 w-72 min-h-full bg-black/50 backdrop-blur-2xl border-r border-white/10 text-gray-300">
                    <div class="flex items-center justify-center py-6 mb-4 border-b border-white/10">
                        <a href="/" class="text-2xl font-bold tracking-tighter text-white flex items-center gap-2">
                            <div class="w-8 h-8 rounded-lg bg-gradient-to-tr from-violet-600 to-sky-400 flex items-center justify-center shadow-lg shadow-violet-500/30">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                            </div>
                            <span class="font-bold tracking-tight text-white">Le<span class="text-sky-400 font-light">on</span></span>
                        </a>
                    </div>
                    
                    <ul class="menu w-full">
                        <li><a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'bg-white/10 text-white font-semibold' : 'hover:bg-white/5 hover:text-white' }} rounded-xl mb-2 transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                            Dashboard
                        </a></li>
                        <li><a href="{{ route('admin.orders') }}" class="{{ request()->routeIs('admin.orders') ? 'bg-white/10 text-white font-semibold' : 'hover:bg-white/5 hover:text-white' }} rounded-xl mb-2 transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                            Data Pesanan
                        </a></li>
                        <li><a href="{{ route('admin.archives') }}" class="{{ request()->routeIs('admin.archives*') ? 'bg-white/10 text-white font-semibold' : 'hover:bg-white/5 hover:text-white' }} rounded-xl mb-2 transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" /></svg>
                            Arsip
                        </a></li>
                        <li>
                            <details {{ request()->routeIs('admin.trash*') ? 'open' : '' }}>
                                <summary class="flex items-center gap-3 {{ request()->routeIs('admin.trash*') ? 'bg-red-500/10 text-red-400 font-semibold border border-red-500/20' : 'hover:bg-red-500/5 hover:text-red-300 text-gray-400' }} rounded-xl mb-2 transition-all cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                    <span class="flex-1">Keranjang Sampah</span>
                                </summary>
                                <ul>
                                    <li><a href="{{ route('admin.trash') }}" class="{{ request()->routeIs('admin.trash') ? 'bg-white/10 text-white font-medium' : 'text-gray-400 hover:text-white hover:bg-white/5' }} rounded-lg mb-1 transition-all">Sampah Pesanan</a></li>
                                    <li><a href="{{ route('admin.trash.archives') }}" class="{{ request()->routeIs('admin.trash.archives') ? 'bg-white/10 text-white font-medium' : 'text-gray-400 hover:text-white hover:bg-white/5' }} rounded-lg transition-all">Sampah Arsip</a></li>
                                </ul>
                            </details>
                        </li>
                        <li><a href="{{ route('admin.platforms') }}" class="{{ request()->routeIs('admin.platforms') ? 'bg-white/10 text-white font-semibold' : 'hover:bg-white/5 hover:text-white' }} rounded-xl mb-2 transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" /></svg>
                            Kelola Platform
                        </a></li>
                        <li><a href="{{ route('admin.users') }}" class="{{ request()->routeIs('admin.users') ? 'bg-white/10 text-white font-semibold' : 'hover:bg-white/5 hover:text-white' }} rounded-xl mb-2 transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                            Kelola Pengguna
                        </a></li>
                    </ul>
                </div>
            
            </div>
        </div>

        <!-- Bottom Navigation (Mobile) -->
        <div class="fixed bottom-0 left-0 right-0 z-50 flex justify-around items-center bg-black/60 backdrop-blur-xl border-t border-white/10 lg:hidden h-16 pb-safe">
            <a href="{{ route('dashboard') }}" class="flex flex-col items-center justify-center w-full h-full {{ request()->routeIs('dashboard') ? 'text-sky-400 bg-white/5 border-t-2 border-sky-400' : 'text-gray-400 hover:bg-white/5 border-t-2 border-transparent' }} transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                <span class="text-[10px] font-medium leading-none">Beranda</span>
            </a>
            <a href="{{ route('admin.orders') }}" class="flex flex-col items-center justify-center w-full h-full {{ request()->routeIs('admin.orders') ? 'text-sky-400 bg-white/5 border-t-2 border-sky-400' : 'text-gray-400 hover:bg-white/5 border-t-2 border-transparent' }} transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                <span class="text-[10px] font-medium leading-none">Pesanan</span>
            </a>
            <a href="{{ route('admin.archives') }}" class="flex flex-col items-center justify-center w-full h-full {{ request()->routeIs('admin.archives*') ? 'text-sky-400 bg-white/5 border-t-2 border-sky-400' : 'text-gray-400 hover:bg-white/5 border-t-2 border-transparent' }} transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" /></svg>
                <span class="text-[10px] font-medium leading-none">Arsip</span>
            </a>
            <div class="dropdown dropdown-top dropdown-end w-full h-full flex flex-col">
                <div tabindex="0" role="button" class="flex flex-col items-center justify-center w-full h-full {{ request()->routeIs('admin.trash*') ? 'text-red-400 bg-white/5 border-t-2 border-red-400' : 'text-gray-400 hover:bg-white/5 border-t-2 border-transparent hover:text-red-400' }} transition-all outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                    <span class="text-[10px] font-medium leading-none">Sampah</span>
                </div>
                <ul tabindex="0" class="dropdown-content z-50 menu p-2 shadow-2xl bg-slate-900/95 backdrop-blur-xl border border-white/10 rounded-box w-48 mb-2">
                    <li><a href="{{ route('admin.trash') }}" class="{{ request()->routeIs('admin.trash') ? 'bg-white/10 text-white' : 'text-gray-300 hover:text-white' }} rounded-lg">Sampah Pesanan</a></li>
                    <li><a href="{{ route('admin.trash.archives') }}" class="{{ request()->routeIs('admin.trash.archives') ? 'bg-white/10 text-white' : 'text-gray-300 hover:text-white' }} rounded-lg">Sampah Arsip</a></li>
                </ul>
            </div>
            <a href="{{ route('admin.platforms') }}" class="flex flex-col items-center justify-center w-full h-full {{ request()->routeIs('admin.platforms') ? 'text-sky-400 bg-white/5 border-t-2 border-sky-400' : 'text-gray-400 hover:bg-white/5 border-t-2 border-transparent' }} transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" /></svg>
                <span class="text-[10px] font-medium leading-none">Platform</span>
            </a>
            <a href="{{ route('admin.users') }}" class="flex flex-col items-center justify-center w-full h-full {{ request()->routeIs('admin.users') ? 'text-sky-400 bg-white/5 border-t-2 border-sky-400' : 'text-gray-400 hover:bg-white/5 border-t-2 border-transparent' }} transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                <span class="text-[10px] font-medium leading-none">Pengguna</span>
            </a>
        </div>
        
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf
        </form>

        @stack('modals')

        <!-- Archive Selector Modal -->
        <livewire:admin.archive-selector-modal />

        <!-- Mencegah Prompt Instalasi PWA Bawaan Browser Muncul di Halaman Admin Ter-Auth -->
        <script>
            window.addEventListener('beforeinstallprompt', (e) => {
                e.preventDefault();
            });
        </script>

        @livewireScripts
    </body>
</html>
