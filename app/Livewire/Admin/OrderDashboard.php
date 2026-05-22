<?php

namespace App\Livewire\Admin;

use App\Models\Archive;
use App\Models\Order;
use App\Models\Platform;
use Livewire\Component;
use Livewire\WithPagination;

class OrderDashboard extends Component
{
    use WithPagination;

    public $dateStart = null;

    public $dateEnd = null;

    public function render()
    {
        // Base query for ALL orders (including soft deleted)
        $allOrdersQuery = Order::withTrashed();

        if ($this->dateStart) {
            $allOrdersQuery->whereDate('created_at', '>=', $this->dateStart);
        }

        if ($this->dateEnd) {
            $allOrdersQuery->whereDate('created_at', '<=', $this->dateEnd);
        }

        // Overall totals (all orders)
        $totalRevenue = (clone $allOrdersQuery)->sum('harga');
        $totalOrders = (clone $allOrdersQuery)->count();
        $totalItems = (clone $allOrdersQuery)->sum('qty');

        // Active orders (not deleted, not archived)
        $activeOrders = (clone $allOrdersQuery)
            ->whereNull('deleted_at')
            ->whereNull('archive_id')
            ->count();
        $activeRevenue = (clone $allOrdersQuery)
            ->whereNull('deleted_at')
            ->whereNull('archive_id')
            ->sum('harga');
        $activeItems = (clone $allOrdersQuery)
            ->whereNull('deleted_at')
            ->whereNull('archive_id')
            ->sum('qty');

        // Archived orders (not deleted, has archive)
        $archivedOrders = (clone $allOrdersQuery)
            ->whereNull('deleted_at')
            ->whereNotNull('archive_id')
            ->count();
        $archivedRevenue = (clone $allOrdersQuery)
            ->whereNull('deleted_at')
            ->whereNotNull('archive_id')
            ->sum('harga');
        $archivedItems = (clone $allOrdersQuery)
            ->whereNull('deleted_at')
            ->whereNotNull('archive_id')
            ->sum('qty');

        // Trashed orders
        $trashedQuery = Order::onlyTrashed();
        if ($this->dateStart) {
            $trashedQuery->whereDate('created_at', '>=', $this->dateStart);
        }
        if ($this->dateEnd) {
            $trashedQuery->whereDate('created_at', '<=', $this->dateEnd);
        }
        $trashedOrders = (clone $trashedQuery)->count();
        $trashedRevenue = (clone $trashedQuery)->sum('harga');
        $trashedItems = (clone $trashedQuery)->sum('qty');

        // Total archives count
        $totalArchives = Archive::count();

        // Top archives with stats
        $topArchives = Archive::withCount('orders')
            ->withSum('orders', 'harga')
            ->withSum('orders', 'qty')
            ->latest()
            ->take(5)
            ->get();

        // Top 5 best-selling items
        $topItems = (clone $allOrdersQuery)
            ->select('nama_barang', \DB::raw('sum(qty) as total_qty'), \DB::raw('sum(harga) as total_harga'), \DB::raw('count(*) as total_orders'))
            ->groupBy('nama_barang')
            ->orderByDesc('total_qty')
            ->take(5)
            ->get();

        // Platform breakdown (all orders including trashed to represent full system)
        $platformBreakdown = (clone $allOrdersQuery)
            ->select(
                'platform',
                \DB::raw('count(*) as total_orders'),
                \DB::raw('sum(harga) as total_revenue'),
                \DB::raw('sum(qty) as total_items'),
                \DB::raw('sum(case when deleted_at is null and archive_id is null then 1 else 0 end) as active_orders'),
                \DB::raw('sum(case when deleted_at is null and archive_id is null then qty else 0 end) as active_items'),
                \DB::raw('sum(case when deleted_at is null and archive_id is null then harga else 0 end) as active_revenue'),
                \DB::raw('sum(case when deleted_at is null and archive_id is not null then 1 else 0 end) as archived_orders'),
                \DB::raw('sum(case when deleted_at is null and archive_id is not null then qty else 0 end) as archived_items'),
                \DB::raw('sum(case when deleted_at is null and archive_id is not null then harga else 0 end) as archived_revenue'),
                \DB::raw('sum(case when deleted_at is not null then 1 else 0 end) as trashed_orders'),
                \DB::raw('sum(case when deleted_at is not null then qty else 0 end) as trashed_items'),
                \DB::raw('sum(case when deleted_at is not null then harga else 0 end) as trashed_revenue')
            )
            ->groupBy('platform')
            ->orderByDesc('total_orders')
            ->get();

        $platformColors = Platform::pluck('color', 'name')->toArray();

        return view('livewire.admin.order-dashboard', [
            'totalRevenue' => $totalRevenue,
            'totalOrders' => $totalOrders,
            'totalItems' => $totalItems,
            'activeOrders' => $activeOrders,
            'activeRevenue' => $activeRevenue,
            'activeItems' => $activeItems,
            'archivedOrders' => $archivedOrders,
            'archivedRevenue' => $archivedRevenue,
            'archivedItems' => $archivedItems,
            'trashedOrders' => $trashedOrders,
            'trashedRevenue' => $trashedRevenue,
            'trashedItems' => $trashedItems,
            'totalArchives' => $totalArchives,
            'topArchives' => $topArchives,
            'topItems' => $topItems,
            'platformBreakdown' => $platformBreakdown,
            'platformColors' => $platformColors,
        ])->layout('layouts.app');
    }
}
