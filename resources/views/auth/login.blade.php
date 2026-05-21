<x-guest-layout>
    <!-- Navbar (Fixed) -->
    <div class="navbar fixed top-0 w-full z-50 px-4 lg:px-12 pt-4 pb-4 backdrop-blur-md bg-black/20 border-b border-white/10 transition-all duration-300">
        <div class="navbar-start">
            <a href="/" class="text-2xl font-bold tracking-tighter text-white flex items-center gap-2">
                <div class="w-8 h-8 rounded-lg bg-gradient-to-tr from-violet-600 to-sky-400 flex items-center justify-center shadow-lg shadow-violet-500/30">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                </div>
                <span class="font-bold tracking-tight text-white">Le<span class="text-sky-400 font-light">on</span></span>
            </a>
        </div>
    </div>

    <div class="min-h-screen flex items-center justify-center relative z-10 pt-24 pb-8 px-4">
        
        <div class="relative group w-full max-w-md">
            <!-- Glowing backdrop effect for the card -->
            <div class="absolute -inset-1 bg-gradient-to-r from-violet-600 to-sky-500 rounded-2xl blur opacity-25 group-hover:opacity-40 transition duration-1000 group-hover:duration-200"></div>
            
            <div class="relative bg-black/40 backdrop-blur-xl border border-white/10 p-8 sm:p-10 rounded-2xl shadow-2xl w-full">
                
                <div class="mb-8 text-center">
                    <h2 class="text-3xl font-bold text-white mb-2">Welcome Back</h2>
                    <p class="text-gray-400 text-sm">Masuk untuk mengelola data pesanan</p>
                </div>

                <x-validation-errors class="mb-4 text-red-400 bg-red-500/10 border border-red-500/20 p-4 rounded-xl text-sm" />

                @session('status')
                    <div class="mb-4 font-medium text-sm text-emerald-400 bg-emerald-500/10 border border-emerald-500/20 p-4 rounded-xl">
                        {{ $value }}
                    </div>
                @endsession

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <div class="space-y-1.5">
                        <label for="username" class="text-xs font-semibold text-gray-300 uppercase tracking-wider">Username</label>
                        <input id="username" type="text" name="username" :value="old('username')" required autofocus autocomplete="username" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-violet-500/50 focus:border-transparent transition-all" placeholder="admin" />
                    </div>

                    <div class="space-y-1.5">
                        <label for="password" class="text-xs font-semibold text-gray-300 uppercase tracking-wider">Kata Sandi</label>
                        <input id="password" type="password" name="password" required autocomplete="current-password" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-violet-500/50 focus:border-transparent transition-all" placeholder="••••••••" />
                    </div>

                    <div class="flex items-center">
                        <label for="remember_me" class="flex items-center cursor-pointer group">
                            <div class="relative flex items-center justify-center">
                                <input type="checkbox" id="remember_me" name="remember" class="peer sr-only" />
                                <div class="w-5 h-5 bg-white/5 border border-white/20 rounded peer-checked:bg-violet-600 peer-checked:border-violet-600 transition-all flex items-center justify-center">
                                    <svg class="w-3 h-3 text-white opacity-0 peer-checked:opacity-100 transition-opacity" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                            </div>
                            <span class="ms-3 text-sm text-gray-400 group-hover:text-gray-300 transition-colors">Ingat saya</span>
                        </label>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full py-3.5 px-4 bg-gradient-to-r from-violet-600 to-sky-500 hover:from-violet-500 hover:to-sky-400 text-white font-semibold rounded-xl shadow-[0_0_20px_rgba(124,58,237,0.3)] hover:shadow-[0_0_30px_rgba(124,58,237,0.5)] transition-all duration-300 flex items-center justify-center gap-2">
                            <span>Masuk</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                        </button>
                    </div>
                </form>

            </div>
        </div>

    </div>
</x-guest-layout>
