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
            'platform' => $platform->name,
        ]);

        Livewire::actingAs($user)
            ->test(OrderDashboard::class)
            ->assertSee('Tokopedia')
            ->assertSee('Rp 100');
    }
}
