<div>
    <x-slot name="header">
        <h2 class="font-bold text-3xl text-transparent bg-clip-text bg-gradient-to-r from-sky-400 to-violet-400 tracking-tight">
            {{ __('Kelola Platform') }}
        </h2>
    </x-slot>

    <!-- Toggle Input Feature -->
    <div class="card bg-white/5 backdrop-blur-xl border border-white/10 shadow-2xl rounded-2xl mb-6">
        <div class="card-body p-5 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center {{ $inputEnabled ? 'bg-emerald-500/20 text-emerald-400' : 'bg-red-500/20 text-red-400' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-white tracking-tight">Fitur Input Pesanan</h3>
                    <p class="text-sm text-gray-400">{{ $inputEnabled ? 'Aktif — pengguna dapat menginput pesanan baru.' : 'Nonaktif — form input pesanan ditutup sementara.' }}</p>
                </div>
            </div>
            <button wire:click="toggleInput" class="relative inline-flex h-8 w-14 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus-visible:ring-2 focus-visible:ring-white/50 {{ $inputEnabled ? 'bg-emerald-500' : 'bg-gray-600' }}" role="switch" aria-checked="{{ $inputEnabled ? 'true' : 'false' }}">
                <span aria-hidden="true" class="pointer-events-none inline-block h-7 w-7 transform rounded-full bg-white shadow-lg ring-0 transition duration-200 ease-in-out {{ $inputEnabled ? 'translate-x-6' : 'translate-x-0' }}"></span>
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        <!-- Form Tambah/Edit -->
        <div class="card bg-white/5 backdrop-blur-xl border border-white/10 shadow-2xl md:col-span-1 h-fit rounded-2xl">
            <div class="card-body p-6">
                <h3 class="card-title text-xl font-bold text-white mb-4 tracking-tight">{{ $editingId ? 'Edit Platform' : 'Tambah Platform Baru' }}</h3>
                
                <form wire:submit.prevent="save">
                    <div class="form-control w-full space-y-2">
                        <label class="label px-0"><span class="text-xs font-semibold text-gray-300 uppercase tracking-wider">Nama Platform</span></label>
                        <input type="text" wire:model="name" placeholder="Misal: Shopee" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-violet-500/50 transition-all" />
                        @error('name') <span class="text-red-400 text-sm mt-1 flex items-center gap-1"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>{{ $message }}</span> @enderror
                    </div>

                    <div class="form-control w-full space-y-2 mt-4">
                        <label class="label px-0"><span class="text-xs font-semibold text-gray-300 uppercase tracking-wider">Warna Identitas</span></label>
                        <div class="flex items-center gap-4 bg-white/5 border border-white/10 rounded-xl p-2">
                            <input type="color" wire:model="color" class="w-10 h-10 rounded cursor-pointer bg-transparent border-0 p-0" />
                            <span class="text-sm text-gray-400">Pilih warna penanda platform</span>
                        </div>
                        @error('color') <span class="text-red-400 text-sm mt-1 flex items-center gap-1"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="flex flex-col sm:flex-row gap-3 mt-8">
                        <button type="submit" class="w-full bg-gradient-to-r from-violet-600 to-sky-500 hover:from-violet-500 hover:to-sky-400 text-white font-semibold py-3 px-6 rounded-xl shadow-lg shadow-violet-500/20 transition-all transform active:scale-[0.98]">{{ $editingId ? 'Simpan Perubahan' : 'Tambah Platform' }}</button>
                        @if($editingId)
                            <button type="button" wire:click="cancelEdit" class="w-full bg-white/5 hover:bg-white/10 text-gray-300 font-semibold py-3 px-6 rounded-xl border border-white/10 transition-all transform active:scale-[0.98]">Batal</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        <!-- Daftar Platform -->
        <div class="card bg-white/5 backdrop-blur-xl border border-white/10 shadow-2xl md:col-span-2 rounded-2xl">
            <div class="card-body p-6">
                <h3 class="card-title text-xl font-bold text-white mb-6 tracking-tight">Daftar Platform Tersedia</h3>
                
                <div class="overflow-x-auto bg-white/5 border border-white/10 rounded-xl">
                    <table class="table w-full">
                        <thead class="text-gray-300 border-b border-white/10 uppercase tracking-wider text-xs">
                            <tr>
                                <th class="bg-transparent border-0 font-medium w-16 text-center">#</th>
                                <th class="bg-transparent border-0 font-medium">Nama Platform</th>
                                <th class="bg-transparent border-0 font-medium text-right pr-6">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($platforms as $index => $platform)
                                <tr class="border-b border-white/5 hover:bg-white/5 transition-colors duration-200">
                                    <td class="bg-transparent border-0 text-center text-gray-400">{{ $index + 1 }}</td>
                                    <td class="bg-transparent border-0 font-semibold text-white">
                                        <div class="flex items-center gap-3">
                                            <div class="w-3 h-3 rounded-full" style="background-color: {{ $platform->color }}; box-shadow: 0 0 10px {{ $platform->color }}80;"></div>
                                            {{ $platform->name }}
                                        </div>
                                    </td>
                                    <td class="bg-transparent border-0 text-right space-x-2 pr-4">
                                        <button wire:click="edit({{ $platform->id }})" title="Edit" class="btn btn-square btn-sm bg-sky-500/20 text-sky-400 border-sky-500/30 hover:bg-sky-500/40 hover:border-sky-500/50 rounded-xl transition-all">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                                        </button>
                                        <button wire:click="delete({{ $platform->id }})" title="Hapus" class="btn btn-square btn-sm bg-red-500/20 text-red-400 border-red-500/30 hover:bg-red-500/40 hover:border-red-500/50 rounded-xl transition-all">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-10 text-gray-400 bg-transparent border-0">
                                        <div class="flex flex-col items-center justify-center space-y-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white/20" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
                                            <p>Belum ada data platform terdaftar.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
    </div>
</div>
