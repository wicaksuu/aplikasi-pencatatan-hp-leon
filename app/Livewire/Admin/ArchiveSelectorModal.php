<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Archive;
use App\Models\Order;

class ArchiveSelectorModal extends Component
{
    public $isOpen = false;
    public $searchArchive = '';
    public $selectedOrderIds = [];
    public $sourceComponent = '';

    #[On('openArchiveModal')]
    public function openModal($data)
    {
        $this->selectedOrderIds = $data['orders'] ?? [];
        $this->sourceComponent = $data['source'] ?? '';
        $this->searchArchive = '';
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->selectedOrderIds = [];
        $this->sourceComponent = '';
        $this->searchArchive = '';
    }

    public function getArchivesProperty()
    {
        if (empty($this->searchArchive)) {
            return Archive::latest()->take(10)->get();
        }

        return Archive::where('name', 'like', '%' . $this->searchArchive . '%')
                      ->latest()
                      ->get();
    }

    public function moveToArchive($archiveId)
    {
        if (empty($this->selectedOrderIds)) return;

        if ($this->sourceComponent === 'trash-order-list') {
            Order::onlyTrashed()->whereIn('id', $this->selectedOrderIds)->restore();
        }
        
        Order::whereIn('id', $this->selectedOrderIds)->update(['archive_id' => $archiveId]);

        $archive = Archive::find($archiveId);

        $this->dispatch('swal:toast', [
            'type' => 'success',
            'title' => count($this->selectedOrderIds) . ' pesanan dipindahkan ke Arsip "' . $archive->name . '".'
        ]);

        $this->dispatch('refreshOrders');
        
        $this->closeModal();
    }

    public function createNewArchive()
    {
        if (empty($this->searchArchive)) return;
        if (empty($this->selectedOrderIds)) return;

        $archive = Archive::create(['name' => $this->searchArchive]);

        if ($this->sourceComponent === 'trash-order-list') {
            Order::onlyTrashed()->whereIn('id', $this->selectedOrderIds)->restore();
        }

        Order::whereIn('id', $this->selectedOrderIds)->update(['archive_id' => $archive->id]);

        $this->dispatch('swal:toast', [
            'type' => 'success',
            'title' => count($this->selectedOrderIds) . ' pesanan dipindahkan ke Arsip Baru "' . $archive->name . '".'
        ]);

        $this->dispatch('refreshOrders');
        
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.admin.archive-selector-modal');
    }
}
