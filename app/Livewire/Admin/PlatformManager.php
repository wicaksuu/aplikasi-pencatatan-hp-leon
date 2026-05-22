<?php

namespace App\Livewire\Admin;

use App\Models\Platform;
use App\Models\Setting;
use Livewire\Attributes\On;
use Livewire\Component;

class PlatformManager extends Component
{
    public $platforms;

    public $name = '';

    public $color = '#38bdf8'; // Default sky-400

    public $editingId = null;

    public $inputEnabled = true;

    public function mount()
    {
        $this->loadPlatforms();
        $this->inputEnabled = (bool) Setting::get('order_input_enabled', true);
    }

    public function loadPlatforms()
    {
        $this->platforms = Platform::latest()->get();
    }

    public function toggleInput()
    {
        $this->inputEnabled = ! $this->inputEnabled;
        Setting::set('order_input_enabled', $this->inputEnabled);

        $this->dispatch('swal:toast', [
            'type' => 'success',
            'title' => $this->inputEnabled ? 'Fitur input pesanan diaktifkan.' : 'Fitur input pesanan dinonaktifkan.',
        ]);
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255|unique:platforms,name,'.$this->editingId,
            'color' => 'required|string|max:20',
        ]);

        if ($this->editingId) {
            Platform::find($this->editingId)?->update([
                'name' => $this->name,
                'color' => $this->color,
            ]);
            $this->dispatch('swal:toast', ['type' => 'success', 'title' => 'Platform berhasil diperbarui.']);
        } else {
            Platform::create([
                'name' => $this->name,
                'color' => $this->color,
            ]);
            $this->dispatch('swal:toast', ['type' => 'success', 'title' => 'Platform berhasil ditambahkan.']);
        }

        $this->reset(['name', 'color', 'editingId']);
        $this->color = '#38bdf8'; // Reset to default
        $this->loadPlatforms();
    }

    public function edit($id)
    {
        $platform = Platform::find($id);
        if ($platform) {
            $this->editingId = $platform->id;
            $this->name = $platform->name;
            $this->color = $platform->color ?? '#38bdf8';
        }
    }

    public function cancelEdit()
    {
        $this->reset(['name', 'color', 'editingId']);
        $this->color = '#38bdf8';
    }

    public function delete($id)
    {
        $this->dispatch('swal:confirm', [
            'type' => 'warning',
            'title' => 'Hapus Platform?',
            'text' => 'Data platform ini akan dihapus secara permanen.',
            'confirmText' => 'Ya, Hapus',
            'method' => 'performDeletePlatform',
            'id' => $id,
        ]);
    }

    #[On('performDeletePlatform')]
    public function performDeletePlatform($id = null)
    {
        if ($id) {
            Platform::find($id)?->delete();
            $this->dispatch('swal:toast', ['type' => 'success', 'title' => 'Platform berhasil dihapus.']);
            $this->loadPlatforms();
        }
    }

    public function render()
    {
        return view('livewire.admin.platform-manager', [
            'platforms' => Platform::latest()->get(),
        ])->layout('layouts.app');
    }
}
