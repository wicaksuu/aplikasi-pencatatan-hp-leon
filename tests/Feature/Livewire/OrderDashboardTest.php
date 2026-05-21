<?php

namespace Tests\Feature\Livewire;

use App\Livewire\Admin\OrderDashboard;
use App\Models\Order;
use App\Models\Platform;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class OrderDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_render_dashboard_with_orders()
    {
        $user = User::factory()->create();
        $platform = Platform::create(['name' => 'Tokopedia']);
        Order::create([
            'no_order' => 'TEST-123',
            'nama_barang' => 'Barang A',
            'nomor_va' => 'VA-1',
            'qty' => 1,
            'harga' => 100,
            'platform' => $platform->name
        ]);

        Livewire::actingAs($user)
            ->test(OrderDashboard::class)
            ->assertSee('TEST-123')
            ->assertSee('Barang A');
    }

    public function test_can_search_orders()
    {
        $user = User::factory()->create();
        $platform = Platform::create(['name' => 'Tokopedia']);
        Order::create([
            'no_order' => 'CARI-INI',
            'nama_barang' => 'Barang A',
            'nomor_va' => 'VA-1',
            'qty' => 1,
            'harga' => 100,
            'platform' => $platform->name
        ]);
        Order::create([
            'no_order' => 'JANGAN-CARI',
            'nama_barang' => 'Barang B',
            'nomor_va' => 'VA-2',
            'qty' => 1,
            'harga' => 100,
            'platform' => $platform->name
        ]);

        Livewire::actingAs($user)
            ->test(OrderDashboard::class)
            ->set('search', 'CARI-INI')
            ->assertSee('CARI-INI')
            ->assertDontSee('JANGAN-CARI');
    }

    public function test_can_soft_delete_order()
    {
        $user = User::factory()->create();
        $platform = Platform::create(['name' => 'Tokopedia']);
        $order = Order::create([
            'no_order' => 'DEL-123',
            'nama_barang' => 'Barang A',
            'nomor_va' => 'VA-1',
            'qty' => 1,
            'harga' => 100,
            'platform' => $platform->name
        ]);

        Livewire::actingAs($user)
            ->test(OrderDashboard::class)
            ->call('deleteOrder', $order->id);

        $this->assertSoftDeleted('orders', ['id' => $order->id]);
    }

    public function test_can_restore_order()
    {
        $user = User::factory()->create();
        $platform = Platform::create(['name' => 'Tokopedia']);
        $order = Order::create([
            'no_order' => 'RES-123',
            'nama_barang' => 'Barang A',
            'nomor_va' => 'VA-1',
            'qty' => 1,
            'harga' => 100,
            'platform' => $platform->name
        ]);
        $order->delete(); // Soft delete it first

        Livewire::actingAs($user)
            ->test(OrderDashboard::class)
            ->set('filterStatus', 'trashed')
            ->call('restoreOrder', $order->id);

        $this->assertNotSoftDeleted('orders', ['id' => $order->id]);
    }
}
