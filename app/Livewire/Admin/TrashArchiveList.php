<?php

namespace App\Livewire\Admin;

use App\Models\Archive;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class TrashArchiveList extends Component
{
    use WithPagination;

    public $search = '';

    public function restoreArchive($id)
    {
        Archive::onlyTrashed()->find($id)?->restore();
        $this->dispatch('swal:toast', [
            'type' => 'success',
            'title' => 'Arsip berhasil dipulihkan.',
        ]);
    }

    public function forceDeleteArchive($id)
    {
        $this->dispatch('swal:confirm', [
            'type' => 'warning',
            'title' => 'Hapus Permanen?',
            'text' => 'Arsip ini dan seluruh isinya akan dihancurkan permanen.',
            'confirmText' => 'Ya, Hancurkan',
            'method' => 'performForceDeleteArchive',
            'id' => $id,
        ]);
    }

    #[On('performForceDeleteArchive')]
    public function performForceDeleteArchive($id = null)
    {
        if ($id) {
            $archive = Archive::onlyTrashed()->find($id);
            if ($archive) {
                $archive->orders()->withTrashed()->forceDelete();
                $archive->forceDelete();

                $this->dispatch('swal:toast', [
                    'type' => 'success',
                    'title' => 'Arsip dan seluruh isinya berhasil dihancurkan.',
                ]);
            }
        }
    }

    public function render()
    {
        $query = Archive::onlyTrashed()->withCount('orders');

        if ($this->search) {
            $query->where('name', 'like', '%'.$this->search.'%');
        }

        return view('livewire.admin.trash-archive-list', [
            'archives' => $query->latest()->paginate(10),
        ])->layout('layouts.app');
    }
}
