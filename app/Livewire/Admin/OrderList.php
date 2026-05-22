<?php

namespace App\Livewire\Admin;

use App\Models\Order;
use App\Models\Platform;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class OrderList extends Component
{
    use WithPagination;

    public $search = '';

    public $dateStart = null;

    public $dateEnd = null;

    public $platformFilter = '';

    public $selectedRows = [];

    public $selectAll = false;

    public $showExportModal = false;

    public $exportType = 'excel';

    public $exportPreviewLimit = 25;

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedRows = $this->ordersQuery->pluck('id')->map(fn ($id) => (string) $id)->toArray();
        } else {
            $this->selectedRows = [];
        }
    }

    public function updatedSelectedRows()
    {
        $this->selectAll = false;
    }

    public function getOrdersQueryProperty()
    {
        $query = Order::whereNull('archive_id');

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

        return $query->latest();
    }

    public function deleteOrder($id)
    {
        $this->dispatch('swal:confirm', [
            'type' => 'warning',
            'title' => 'Hapus Pesanan?',
            'text' => 'Pesanan ini akan dihapus (masuk keranjang sampah).',
            'confirmText' => 'Ya, Hapus',
            'method' => 'performDeleteOrder',
            'id' => $id,
        ]);
    }

    #[On('performDeleteOrder')]
    public function performDeleteOrder($id = null)
    {
        if ($id) {
            Order::find($id)?->delete();
            $this->dispatch('swal:toast', [
                'type' => 'success',
                'title' => 'Pesanan berhasil dihapus.',
            ]);
        }
    }

    public function deleteSelected()
    {
        if (count($this->selectedRows) > 0) {
            $this->dispatch('swal:confirm', [
                'type' => 'warning',
                'title' => 'Hapus '.count($this->selectedRows).' Data?',
                'text' => 'Pesanan yang dipilih akan dihapus.',
                'confirmText' => 'Ya, Hapus',
                'method' => 'performDeleteSelected',
                'id' => null,
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

    #[On('refreshOrders')]
    public function refreshOrders()
    {
        $this->selectedRows = [];
        $this->selectAll = false;
    }

    public function promptArchive()
    {
        if (count($this->selectedRows) > 0) {
            $this->dispatch('openArchiveModal', [
                'orders' => $this->selectedRows,
                'source' => 'order-list',
            ]);
        }
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
        return Order::whereNull('archive_id')->latest()->limit($this->exportPreviewLimit)->get();
    }

    public function loadMoreExportPreview()
    {
        if ($this->exportPreviewLimit >= $this->exportTotal) {
            return;
        }
        $this->exportPreviewLimit += 25;
    }

    public function getExportTotalProperty()
    {
        return Order::whereNull('archive_id')->count();
    }

    public function render()
    {
        $query = $this->ordersQuery;

        // Menghitung statistik berdasarkan filter saat ini
        $totalRevenue = (clone $query)->sum('harga');
        $totalOrders = (clone $query)->count();
        $totalItems = (clone $query)->sum('qty');

        $platformColors = Platform::pluck('color', 'name')->toArray();
        $platforms = Platform::orderBy('name')->pluck('name');

        return view('livewire.admin.order-list', [
            'orders' => $query->paginate(10),
            'totalRevenue' => $totalRevenue,
            'totalOrders' => $totalOrders,
            'totalItems' => $totalItems,
            'platformColors' => $platformColors,
            'platforms' => $platforms,
        ])->layout('layouts.app');
    }
}
