<?php

namespace Tests\Feature\Livewire;

use App\Livewire\Admin\TrashOrderList;
use App\Models\Order;
use App\Models\Platform;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class TrashOrderListTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_render_trash_order_list()
    {
        $user = User::factory()->create();
        $platform = Platform::create(['name' => 'Tokopedia', 'color' => '#38bdf8']);
        $order = Order::create([
            'no_order' => 'TEST-TRASH',
            'nama_barang' => 'Barang A',
            'nomor_va' => 'VA-1',
            'qty' => 1,
            'harga' => 100,
            'platform' => $platform->name,
        ]);
        $order->delete(); // Soft delete

        Livewire::actingAs($user)
            ->test(TrashOrderList::class)
            ->assertSee('TEST-TRASH')
            ->assertSee('Barang A');
    }

    public function test_can_restore_order()
    {
        $user = User::factory()->create();
        $platform = Platform::create(['name' => 'Tokopedia', 'color' => '#38bdf8']);
        $order = Order::create([
            'no_order' => 'RES-123',
            'nama_barang' => 'Barang A',
            'nomor_va' => 'VA-1',
            'qty' => 1,
            'harga' => 100,
            'platform' => $platform->name,
        ]);
        $order->delete(); // Soft delete it first

        Livewire::actingAs($user)
            ->test(TrashOrderList::class)
            ->call('restoreOrder', $order->id);

        $this->assertNotSoftDeleted('orders', ['id' => $order->id]);
    }
}
