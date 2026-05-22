<?php

namespace Tests\Feature\Livewire;

use App\Livewire\Admin\OrderList;
use App\Models\Order;
use App\Models\Platform;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class OrderListTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_render_order_list_with_orders()
    {
        $user = User::factory()->create();
        $platform = Platform::create(['name' => 'Tokopedia', 'color' => '#38bdf8']);
        Order::create([
            'no_order' => 'TEST-123',
            'nama_barang' => 'Barang A',
            'nomor_va' => 'VA-1',
            'qty' => 1,
            'harga' => 100,
            'platform' => $platform->name,
        ]);

        Livewire::actingAs($user)
            ->test(OrderList::class)
            ->assertSee('TEST-123')
            ->assertSee('Barang A');
    }

    public function test_can_search_orders()
    {
        $user = User::factory()->create();
        $platform = Platform::create(['name' => 'Tokopedia', 'color' => '#38bdf8']);
        Order::create([
            'no_order' => 'CARI-INI',
            'nama_barang' => 'Barang A',
            'nomor_va' => 'VA-1',
            'qty' => 1,
            'harga' => 100,
            'platform' => $platform->name,
        ]);
        Order::create([
            'no_order' => 'JANGAN-CARI',
            'nama_barang' => 'Barang B',
            'nomor_va' => 'VA-2',
            'qty' => 1,
            'harga' => 100,
            'platform' => $platform->name,
        ]);

        Livewire::actingAs($user)
            ->test(OrderList::class)
            ->set('search', 'CARI-INI')
            ->assertViewHas('orders', function ($orders) {
                return $orders->contains('no_order', 'CARI-INI') &&
                      ! $orders->contains('no_order', 'JANGAN-CARI');
            });
    }

    public function test_can_soft_delete_order()
    {
        $user = User::factory()->create();
        $platform = Platform::create(['name' => 'Tokopedia', 'color' => '#38bdf8']);
        $order = Order::create([
            'no_order' => 'DEL-123',
            'nama_barang' => 'Barang A',
            'nomor_va' => 'VA-1',
            'qty' => 1,
            'harga' => 100,
            'platform' => $platform->name,
        ]);

        Livewire::actingAs($user)
            ->test(OrderList::class)
            ->call('deleteOrder', $order->id)
            ->call('performDeleteOrder', $order->id);

        $this->assertSoftDeleted('orders', ['id' => $order->id]);
    }
}
