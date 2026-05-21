<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-primary leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div>
        @livewire('admin.order-dashboard')
    </div>
</x-app-layout>
