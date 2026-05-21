<div>
    <x-slot name="header">
        <h2 class="font-bold text-3xl text-transparent bg-clip-text bg-gradient-to-r from-sky-400 to-violet-400 tracking-tight">
            {{ __('Kelola Pengguna') }}
        </h2>
    </x-slot>

    <div class="card bg-white/5 backdrop-blur-xl border border-white/10 shadow-2xl rounded-2xl">
        <div class="card-body p-4 sm:p-6 lg:p-8 text-white">

            <!-- Toolbar -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
                <div class="relative w-full sm:max-w-md">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" /></svg>
                    </div>
                    <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari nama, username, atau email..." class="w-full bg-black/20 backdrop-blur-md border border-white/10 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-violet-500/50 rounded-xl pl-11 pr-4 py-3.5 transition-all shadow-inner" />
                </div>

                <button wire:click="openModal" class="btn bg-gradient-to-r from-violet-600 to-sky-500 hover:from-violet-500 hover:to-sky-400 text-white border-0 rounded-xl shadow-lg shadow-violet-500/20 transition-all flex items-center gap-2 shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                    Tambah Pengguna
                </button>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto bg-white/5 border border-white/10 rounded-2xl backdrop-blur-md">
                <table class="table table-sm w-full">
                    <thead class="text-gray-300 border-b border-white/10 uppercase tracking-wider text-xs">
                        <tr>
                            <th class="bg-transparent border-0 font-medium whitespace-nowrap">Nama</th>
                            <th class="bg-transparent border-0 font-medium whitespace-nowrap">Username</th>
                            <th class="bg-transparent border-0 font-medium whitespace-nowrap">Email</th>
                            <th class="bg-transparent border-0 font-medium text-center whitespace-nowrap">Terverifikasi</th>
                            <th class="bg-transparent border-0 font-medium text-center whitespace-nowrap">Dibuat</th>
                            <th class="bg-transparent border-0 font-medium text-right pr-4 whitespace-nowrap">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr class="border-b border-white/5 hover:bg-white/5 transition-colors duration-200">
                                <td class="bg-transparent border-0 whitespace-nowrap">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-full bg-gradient-to-tr from-violet-600 to-sky-400 flex items-center justify-center text-sm font-bold text-white shrink-0">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                        <div class="font-semibold text-white">{{ $user->name }}</div>
                                    </div>
                                </td>
                                <td class="bg-transparent border-0 whitespace-nowrap font-mono text-sm text-sky-300">{{ $user->username }}</td>
                                <td class="bg-transparent border-0 whitespace-nowrap text-sm text-gray-300">{{ $user->email }}</td>
                                <td class="bg-transparent border-0 text-center whitespace-nowrap">
                                    @if($user->email_verified_at)
                                        <span class="badge badge-sm bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 px-2 py-1 rounded-lg">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 inline mr-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                            Terverifikasi
                                        </span>
                                    @else
                                        <span class="badge badge-sm bg-yellow-500/10 text-yellow-400 border border-yellow-500/20 px-2 py-1 rounded-lg">Belum</span>
                                    @endif
                                </td>
                                <td class="bg-transparent border-0 text-center whitespace-nowrap text-xs text-gray-400">{{ $user->created_at->format('d M Y') }}</td>
                                <td class="text-right space-x-1 bg-transparent border-0 pr-4 whitespace-nowrap">
                                    <button wire:click="edit({{ $user->id }})" title="Edit" class="btn btn-square btn-sm bg-sky-500/20 text-sky-400 border-sky-500/30 hover:bg-sky-500/40 hover:border-sky-500/50 rounded-xl transition-all">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                                    </button>
                                    <button wire:click="delete({{ $user->id }})" title="Hapus" class="btn btn-square btn-sm bg-red-500/20 text-red-400 border-red-500/30 hover:bg-red-500/40 hover:border-red-500/50 rounded-xl transition-all">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-12 text-gray-400 bg-transparent border-0">
                                    <div class="flex flex-col items-center justify-center space-y-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white/20" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                                        <p class="text-lg">Belum ada data pengguna.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $users->links(data: ['scrollTo' => false]) }}
            </div>
        </div>
    </div>

    <!-- Create / Edit Modal -->
    <x-dark-modal wire:model="showModal" maxWidth="lg">
        <div class="flex flex-col">
            <!-- Header -->
            <div class="flex items-center justify-between px-6 py-4 border-b border-white/10 shrink-0">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-violet-500/10 border border-violet-500/20 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-violet-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-white">{{ $editingId ? 'Edit Pengguna' : 'Tambah Pengguna' }}</h3>
                        <p class="text-xs text-gray-400">{{ $editingId ? 'Perbarui data pengguna yang ada.' : 'Buat akun pengguna baru.' }}</p>
                    </div>
                </div>
                <button wire:click="closeModal" class="btn btn-sm btn-ghost btn-square text-gray-400 hover:text-white hover:bg-white/10 rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>

            <!-- Form -->
            <form wire:submit.prevent="save" class="px-6 py-5 space-y-4 overflow-y-auto max-h-[70vh]">
                <div>
                    <label class="label px-0"><span class="text-xs font-semibold text-gray-300 uppercase tracking-wider">Nama Lengkap</span></label>
                    <input type="text" wire:model="name" placeholder="Nama lengkap" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-violet-500/50 transition-all" />
                    @error('name') <span class="text-red-400 text-sm mt-1 flex items-center gap-1"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="label px-0"><span class="text-xs font-semibold text-gray-300 uppercase tracking-wider">Username</span></label>
                    <input type="text" wire:model="username" placeholder="username" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-violet-500/50 transition-all" />
                    @error('username') <span class="text-red-400 text-sm mt-1 flex items-center gap-1"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="label px-0"><span class="text-xs font-semibold text-gray-300 uppercase tracking-wider">Email</span></label>
                    <input type="email" wire:model="email" placeholder="email@contoh.com" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-violet-500/50 transition-all" />
                    @error('email') <span class="text-red-400 text-sm mt-1 flex items-center gap-1"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="label px-0"><span class="text-xs font-semibold text-gray-300 uppercase tracking-wider">Password {{ $editingId ? '(Kosongkan jika tidak diubah)' : '' }}</span></label>
                    <input type="password" wire:model="password" placeholder="••••••••" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-violet-500/50 transition-all" />
                    @error('password') <span class="text-red-400 text-sm mt-1 flex items-center gap-1"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="label px-0"><span class="text-xs font-semibold text-gray-300 uppercase tracking-wider">Konfirmasi Password</span></label>
                    <input type="password" wire:model="password_confirmation" placeholder="••••••••" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-violet-500/50 transition-all" />
                    @error('password_confirmation') <span class="text-red-400 text-sm mt-1 flex items-center gap-1"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>{{ $message }}</span> @enderror
                </div>
            </form>

            <!-- Footer -->
            <div class="flex items-center justify-end px-6 py-4 border-t border-white/10 shrink-0 bg-black/20 gap-3">
                <button type="button" wire:click="closeModal" class="btn btn-sm bg-white/5 hover:bg-white/10 text-gray-300 border border-white/10 rounded-xl transition-all">Batal</button>
                <button type="button" wire:click="save" class="btn btn-sm bg-gradient-to-r from-violet-600 to-sky-500 hover:from-violet-500 hover:to-sky-400 text-white border-0 rounded-xl shadow-lg shadow-violet-500/20 transition-all flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                    {{ $editingId ? 'Simpan Perubahan' : 'Tambah Pengguna' }}
                </button>
            </div>
        </div>
    </x-dark-modal>
</div>
