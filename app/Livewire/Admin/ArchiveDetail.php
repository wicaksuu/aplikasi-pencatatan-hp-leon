<?php

namespace App\Livewire\Admin;

use App\Models\Archive;
use App\Models\Order;
use App\Models\Platform;
use Livewire\Component;
use Livewire\WithPagination;

class ArchiveDetail extends Component
{
    use WithPagination;

    public $archiveId;

    public $search = '';

    public $dateStart;

    public $dateEnd;

    public $platformFilter = '';

    public $selectedRows = [];

    public $selectAll = false;

    public $showExportModal = false;

    public $exportType = 'excel';

    public $exportPreviewLimit = 25;

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedRows = Order::where('archive_id', $this->archiveId)->pluck('id')->map(fn ($id) => (string) $id)->toArray();
        } else {
            $this->selectedRows = [];
        }
    }

    public function updatedSelectedRows()
    {
        $this->selectAll = false;
    }

    #[On('refreshOrders')]
    public function refreshOrders()
    {
        $this->selectedRows = [];
        $this->selectAll = false;
    }

    public function mount($id)
    {
        $this->archiveId = $id;
        $archive = Archive::findOrFail($id);
    }

    public function getArchiveProperty()
    {
        return Archive::findOrFail($this->archiveId);
    }

    public function render()
    {
        $query = Order::where('archive_id', $this->archiveId);

        if ($this->dateStart) {
            $query->whereDate('created_at', '>=', $this->dateStart);
        }

        if ($this->dateEnd) {
            $query->whereDate('created_at', '<=', $this->dateEnd);
        }

        if ($this->platformFilter) {
            $query->where('platform', $this->platformFilter);
        }

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('nama_barang', 'like', '%'.$this->search.'%')
                    ->orWhere('no_order', 'like', '%'.$this->search.'%')
                    ->orWhere('nomor_va', 'like', '%'.$this->search.'%');
            });
        }

        $orders = $query->latest()->paginate(10);
        $totalItems = (clone $query)->sum('qty');
        $totalOrders = (clone $query)->count();
        $totalRevenue = (clone $query)->sum('harga');
        $platformColors = Platform::pluck('color', 'name')->toArray();
        $platforms = Platform::orderBy('name')->pluck('name');

        return view('livewire.admin.archive-detail', [
            'orders' => $orders,
            'totalItems' => $totalItems,
            'totalOrders' => $totalOrders,
            'totalRevenue' => $totalRevenue,
            'platformColors' => $platformColors,
            'platforms' => $platforms,
        ])->layout('layouts.app');
    }

    private function getFilteredOrdersQuery()
    {
        $query = Order::where('archive_id', $this->archiveId);

        if ($this->dateStart) {
            $query->whereDate('created_at', '>=', $this->dateStart);
        }

        if ($this->dateEnd) {
            $query->whereDate('created_at', '<=', $this->dateEnd);
        }

        if ($this->platformFilter) {
            $query->where('platform', $this->platformFilter);
        }

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('nama_barang', 'like', '%'.$this->search.'%')
                    ->orWhere('no_order', 'like', '%'.$this->search.'%')
                    ->orWhere('nomor_va', 'like', '%'.$this->search.'%');
            });
        }

        return $query;
    }

    public function openExportModal($type)
    {
        $this->exportType = $type;
        $this->exportPreviewLimit = 25;
        $this->showExportModal = true;
    }

    public function closeExportModal()
    {
        $this->showExportModal = false;
    }

    public function getExportPreviewProperty()
    {
        return $this->getFilteredOrdersQuery()->latest()->limit($this->exportPreviewLimit)->get();
    }

    public function getExportTotalProperty()
    {
        return $this->getFilteredOrdersQuery()->count();
    }

    public function loadMoreExportPreview()
    {
        if ($this->exportPreviewLimit >= $this->exportTotal) {
            return;
        }
        $this->exportPreviewLimit += 25;
    }

    public function promptMoveArchive()
    {
        if (count($this->selectedRows) > 0) {
            $this->dispatch('openArchiveModal', [
                'orders' => $this->selectedRows,
                'source' => 'archive-detail',
            ]);
        }
    }

    public function removeFromArchiveSelected()
    {
        if (count($this->selectedRows) > 0) {
            Order::whereIn('id', $this->selectedRows)->update(['archive_id' => null]);
            $count = count($this->selectedRows);
            $this->selectedRows = [];
            $this->selectAll = false;
            $this->dispatch('swal:toast', [
                'type' => 'success',
                'title' => $count.' pesanan dikeluarkan dari arsip.',
            ]);
        }
    }

    public function deleteSelected()
    {
        if (count($this->selectedRows) > 0) {
            $this->dispatch('swal:confirm', [
                'type' => 'warning',
                'title' => 'Hapus '.count($this->selectedRows).' Data?',
                'text' => 'Pesanan yang dipilih akan dihapus (masuk keranjang sampah).',
                'confirmText' => 'Ya, Hapus',
                'method' => 'performDeleteSelected',
            ]);
        }
    }

    #[On('performDeleteSelected')]
    public function performDeleteSelected()
    {
        Order::whereIn('id', $this->selectedRows)->delete();
        $count = count($this->selectedRows);
        $this->selectedRows = [];
        $this->selectAll = false;
        $this->dispatch('swal:toast', [
            'type' => 'success',
            'title' => $count.' pesanan berhasil dihapus.',
        ]);
    }
}
