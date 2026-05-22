<?php

namespace App\Livewire\Admin;

use App\Models\Order;
use App\Models\Platform;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class TrashOrderList extends Component
{
    use WithPagination;

    public $search = '';

    public $dateStart = null;

    public $dateEnd = null;

    public $platformFilter = '';

    public $selectedRows = [];

    public $selectAll = false;

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

    #[On('refreshOrders')]
    public function refreshOrders()
    {
        $this->selectedRows = [];
        $this->selectAll = false;
    }

    public function getOrdersQueryProperty()
    {
        $query = Order::onlyTrashed();

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

    public function restoreOrder($id)
    {
        Order::onlyTrashed()->find($id)?->restore();
        $this->dispatch('swal:toast', [
            'type' => 'success',
            'title' => 'Pesanan berhasil dipulihkan.',
        ]);
    }

    public function forceDeleteOrder($id)
    {
        $this->dispatch('swal:confirm', [
            'type' => 'warning',
            'title' => 'Hapus Permanen?',
            'text' => 'Pesanan ini akan dihapus permanen dan tidak dapat dipulihkan.',
            'confirmText' => 'Ya, Hapus Permanen',
            'method' => 'performForceDeleteOrder',
            'id' => $id,
        ]);
    }

    #[On('performForceDeleteOrder')]
    public function performForceDeleteOrder($id = null)
    {
        if ($id) {
            Order::onlyTrashed()->find($id)?->forceDelete();
            $this->dispatch('swal:toast', [
                'type' => 'success',
                'title' => 'Pesanan berhasil dihapus permanen.',
            ]);
        }
    }

    public function restoreSelected()
    {
        if (count($this->selectedRows) > 0) {
            Order::onlyTrashed()->whereIn('id', $this->selectedRows)->restore();
            $count = count($this->selectedRows);
            $this->selectedRows = [];
            $this->selectAll = false;
            $this->dispatch('swal:toast', [
                'type' => 'success',
                'title' => $count.' pesanan berhasil dipulihkan.',
            ]);
        }
    }

    public function forceDeleteSelected()
    {
        if (count($this->selectedRows) > 0) {
            $this->dispatch('swal:confirm', [
                'type' => 'warning',
                'title' => 'Hapus Permanen '.count($this->selectedRows).' Data?',
                'text' => 'Pesanan yang dipilih akan dihapus secara permanen.',
                'confirmText' => 'Ya, Hapus Permanen',
                'method' => 'performForceDeleteSelected',
                'id' => null,
            ]);
        }
    }

    public function promptRestoreAndArchive()
    {
        if (count($this->selectedRows) > 0) {
            $this->dispatch('openArchiveModal', [
                'orders' => $this->selectedRows,
                'source' => 'trash-order-list',
            ]);
        }
    }

    #[On('performForceDeleteSelected')]
    public function performForceDeleteSelected()
    {
        Order::onlyTrashed()->whereIn('id', $this->selectedRows)->forceDelete();
        $count = count($this->selectedRows);
        $this->selectedRows = [];
        $this->selectAll = false;
        $this->dispatch('swal:toast', [
            'type' => 'success',
            'title' => $count.' pesanan berhasil dihapus permanen.',
        ]);
    }

    public function render()
    {
        $query = $this->ordersQuery;

        $totalItems = (clone $query)->sum('qty');
        $totalOrders = (clone $query)->count();

        $platformColors = Platform::pluck('color', 'name')->toArray();
        $platforms = Platform::orderBy('name')->pluck('name');

        return view('livewire.admin.trash-order-list', [
            'orders' => $query->paginate(10),
            'totalItems' => $totalItems,
            'totalOrders' => $totalOrders,
            'platformColors' => $platformColors,
            'platforms' => $platforms,
        ])->layout('layouts.app');
    }
}
