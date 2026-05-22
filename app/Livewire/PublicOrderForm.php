<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\Platform;
use App\Models\Setting;
use Livewire\Component;

class PublicOrderForm extends Component
{
    public $nama_barang;

    public $no_order;

    public $nomor_va;

    public $qty = 1;

    public $harga;

    public $platform = '';

    public $platforms = [];

    public $platformsData = [];

    public $inputEnabled = true;

    public $suggestions = [];

    public function mount()
    {
        $this->platforms = Platform::pluck('name')->toArray();
        $this->platformsData = Platform::all()->toArray();
        $this->inputEnabled = (bool) Setting::get('order_input_enabled', true);
    }

    protected function rules()
    {
        return [
            'nama_barang' => 'required|string|min:3|max:255',
            'no_order' => 'required|string|unique:orders,no_order|max:255',
            'nomor_va' => 'nullable|string|max:255',
            'qty' => 'required|integer|min:1',
            'harga' => 'required|numeric|min:0',
            'platform' => 'required|string|in:'.implode(',', $this->platforms),
        ];
    }

    protected function messages()
    {
        return [
            'nama_barang.required' => 'Nama barang wajib diisi.',
            'nama_barang.min' => 'Nama barang minimal 3 karakter.',
            'nama_barang.max' => 'Nama barang maksimal 255 karakter.',
            'no_order.required' => 'No order wajib diisi.',
            'no_order.unique' => 'No order sudah pernah digunakan.',
            'no_order.max' => 'No order maksimal 255 karakter.',
            'nomor_va.max' => 'Nomor VA maksimal 255 karakter.',
            'qty.required' => 'Quantity wajib diisi.',
            'qty.integer' => 'Quantity harus berupa angka.',
            'qty.min' => 'Quantity minimal 1.',
            'harga.required' => 'Harga wajib diisi.',
            'harga.numeric' => 'Harga harus berupa angka.',
            'harga.min' => 'Harga tidak boleh kurang dari 0.',
            'platform.required' => 'Platform wajib dipilih.',
            'platform.in' => 'Platform yang dipilih tidak valid.',
        ];
    }

    public function searchBarang()
    {
        if (strlen($this->nama_barang) >= 2) {
            $this->suggestions = Order::where('nama_barang', 'like', '%'.$this->nama_barang.'%')
                ->select('nama_barang')
                ->distinct()
                ->orderBy('nama_barang')
                ->limit(5)
                ->pluck('nama_barang')
                ->toArray();
        } else {
            $this->suggestions = [];
        }
    }

    public function selectBarang($name)
    {
        $this->nama_barang = $name;
        $this->suggestions = [];
    }

    public function submit()
    {
        if (! $this->inputEnabled) {
            $this->dispatch('swal:toast', [
                'type' => 'error',
                'title' => 'Fitur input pesanan sedang dinonaktifkan.',
            ]);

            return;
        }

        $this->validate();

        Order::create([
            'nama_barang' => $this->nama_barang,
            'no_order' => $this->no_order,
            'nomor_va' => $this->nomor_va,
            'qty' => $this->qty,
            'harga' => $this->harga,
            'platform' => $this->platform,
        ]);

        session()->flash('message', 'Data pesanan berhasil disimpan');

        $this->dispatch('swal:toast', [
            'type' => 'success',
            'title' => 'Data pesanan berhasil disimpan.',
        ]);

        $this->reset(['nama_barang', 'no_order', 'nomor_va', 'qty', 'harga', 'platform']);
        $this->qty = 1;
        $this->platform = '';
        $this->suggestions = [];
    }

    public function render()
    {
        return view('livewire.public-order-form')->layout('layouts.guest');
    }
}
