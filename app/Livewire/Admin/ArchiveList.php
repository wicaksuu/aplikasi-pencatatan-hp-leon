<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use App\Models\Archive;
use App\Models\Order;

class ArchiveList extends Component
{
    use WithPagination;

    public $search = '';
    public $showCreateModal = false;
    public $newArchiveName = '';

    public $showExportModal = false;
    public $exportType = 'excel';
    public $exportArchiveId = null;
    public $exportPreviewLimit = 25;

    public function openExportModal($type, $archiveId)
    {
        $this->exportType = $type;
        $this->exportArchiveId = $archiveId;
        $this->exportPreviewLimit = 25;
        $this->showExportModal = true;
    }

    public function closeExportModal()
    {
        $this->showExportModal = false;
    }

    public function getExportPreviewProperty()
    {
        return Order::where('archive_id', $this->exportArchiveId)->latest()->limit($this->exportPreviewLimit)->get();
    }

    public function getExportTotalProperty()
    {
        return Order::where('archive_id', $this->exportArchiveId)->count();
    }

    public function loadMoreExportPreview()
    {
        if ($this->exportPreviewLimit >= $this->exportTotal) {
            return;
        }
        $this->exportPreviewLimit += 25;
    }

    public function openCreateModal()
    {
        $this->newArchiveName = '';
        $this->showCreateModal = true;
    }

    public function closeCreateModal()
    {
        $this->showCreateModal = false;
        $this->newArchiveName = '';
    }

    public function createArchive()
    {
        $this->validate([
            'newArchiveName' => 'required|string|max:255|unique:archives,name'
        ], [
            'newArchiveName.required' => 'Nama arsip wajib diisi.',
            'newArchiveName.unique' => 'Nama arsip sudah ada.'
        ]);

        Archive::create(['name' => $this->newArchiveName]);

        $this->dispatch('swal:toast', [
            'type' => 'success',
            'title' => 'Arsip baru berhasil dibuat.'
        ]);

        $this->closeCreateModal();
    }

    public function deleteArchive($id)
    {
        $this->dispatch('swal:confirm', [
            'type' => 'warning',
            'title' => 'Buang ke Sampah?',
            'text' => 'Arsip ini akan dipindahkan ke keranjang sampah.',
            'confirmText' => 'Ya, Buang',
            'method' => 'performDeleteArchive',
            'id' => $id
        ]);
    }

    #[On('performDeleteArchive')]
    public function performDeleteArchive($id = null)
    {
        if ($id) {
            Archive::find($id)?->delete();
            $this->dispatch('swal:toast', [
                'type' => 'success',
                'title' => 'Arsip berhasil dibuang ke sampah.'
            ]);
        }
    }

    public function render()
    {
        $query = Archive::withCount('orders')
                        ->withSum('orders', 'harga')
                        ->withSum('orders', 'qty');

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        $platformColors = \App\Models\Platform::pluck('color', 'name')->toArray();

        return view('livewire.admin.archive-list', [
            'archives' => $query->latest()->paginate(10),
            'platformColors' => $platformColors
        ])->layout('layouts.app');
    }
}
