@props(['id', 'maxWidth'])

@php
$id = $id ?? md5($attributes->wire('model'));

$maxWidth = [
    'sm' => 'max-w-sm',
    'md' => 'max-w-md',
    'lg' => 'max-w-lg',
    'xl' => 'max-w-xl',
    '2xl' => 'max-w-2xl',
    '4xl' => 'max-w-4xl',
    '5xl' => 'max-w-5xl',
    '7xl' => 'max-w-7xl',
][$maxWidth ?? '2xl'];
@endphp

@teleport('body')
<div
    x-data="{ show: @entangle($attributes->wire('model')) }"
    x-on:close.stop="show = false"
    x-on:keydown.escape.window="show = false"
    x-show="show"
    id="{{ $id }}"
    class="fixed inset-0 z-[9999] flex items-center justify-center p-4 overflow-y-auto"
    style="display: none;"
    x-cloak
>
    <!-- Backdrop -->
    <div x-show="show" class="fixed inset-0 transition-opacity" x-on:click="show = false"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        <div class="fixed inset-0 bg-black/60 backdrop-blur-sm"></div>
    </div>

    <!-- Modal Panel -->
    <div x-show="show"
         class="relative w-full {{ $maxWidth }} max-w-[95vw] mx-auto my-auto bg-[#0d1117] border border-white/10 rounded-2xl shadow-2xl shadow-black/50 overflow-hidden transform transition-all"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
        {{ $slot }}
    </div>
</div>
@endteleport
