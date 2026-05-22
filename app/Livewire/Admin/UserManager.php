<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class UserManager extends Component
{
    use WithPagination;

    public $name = '';

    public $username = '';

    public $email = '';

    public $password = '';

    public $password_confirmation = '';

    public $showModal = false;

    public $editingId = null;

    public $search = '';

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,'.$this->editingId,
            'email' => 'required|email|max:255|unique:users,email,'.$this->editingId,
            'password' => ($this->editingId ? 'nullable' : 'required').'|min:8',
            'password_confirmation' => $this->password ? 'required|same:password' : 'nullable',
        ];
    }

    public function openModal()
    {
        $this->reset(['name', 'username', 'email', 'password', 'password_confirmation', 'editingId']);
        $this->showModal = true;
    }

    public function edit($id)
    {
        $user = User::find($id);
        if (! $user) {
            $this->dispatch('swal:toast', ['type' => 'error', 'title' => 'Pengguna tidak ditemukan.']);

            return;
        }

        $this->editingId = $user->id;
        $this->name = $user->name;
        $this->username = $user->username;
        $this->email = $user->email;
        $this->password = '';
        $this->password_confirmation = '';
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->reset(['name', 'username', 'email', 'password', 'password_confirmation', 'editingId']);
        $this->resetValidation();
    }

    public function save()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
        ];

        if ($this->editingId) {
            if ($this->password) {
                $data['password'] = bcrypt($this->password);
            }
            User::find($this->editingId)?->update($data);
            $this->dispatch('swal:toast', ['type' => 'success', 'title' => 'Pengguna berhasil diperbarui.']);
        } else {
            $data['password'] = bcrypt($this->password);
            User::create($data);
            $this->dispatch('swal:toast', ['type' => 'success', 'title' => 'Pengguna berhasil ditambahkan.']);
        }

        $this->closeModal();
    }

    public function delete($id)
    {
        $user = User::find($id);
        if (! $user) {
            $this->dispatch('swal:toast', ['type' => 'error', 'title' => 'Pengguna tidak ditemukan.']);

            return;
        }

        if ($user->id === auth()->id()) {
            $this->dispatch('swal:toast', ['type' => 'error', 'title' => 'Tidak dapat menghapus akun sendiri.']);

            return;
        }

        $this->dispatch('swal:confirm', [
            'type' => 'warning',
            'title' => 'Hapus Pengguna?',
            'text' => "Pengguna {$user->name} akan dihapus secara permanen.",
            'confirmText' => 'Ya, Hapus',
            'method' => 'performDeleteUser',
            'id' => $id,
        ]);
    }

    #[On('performDeleteUser')]
    public function performDeleteUser($id = null)
    {
        if ($id) {
            $user = User::find($id);
            if ($user) {
                if ($user->id === auth()->id()) {
                    $this->dispatch('swal:toast', ['type' => 'error', 'title' => 'Tidak dapat menghapus akun sendiri.']);

                    return;
                }
                $user->delete();
                $this->dispatch('swal:toast', ['type' => 'success', 'title' => 'Pengguna berhasil dihapus.']);
            }
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $users = User::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', "%{$this->search}%")
                        ->orWhere('username', 'like', "%{$this->search}%")
                        ->orWhere('email', 'like', "%{$this->search}%");
                });
            })
            ->latest()
            ->paginate(10);

        return view('livewire.admin.user-manager', [
            'users' => $users,
        ])->layout('layouts.app');
    }
}
