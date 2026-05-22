<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\Platform;
use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        $totalOrders = Order::withTrashed()->count();
        $totalRevenue = Order::withTrashed()->sum('harga');
        $totalItems = Order::withTrashed()->sum('qty');
        $platforms = Platform::count();

        return view('livewire.home', [
            'totalOrders' => $totalOrders,
            'totalRevenue' => $totalRevenue,
            'totalItems' => $totalItems,
            'platforms' => $platforms,
        ])->layout('layouts.guest');
    }
}
