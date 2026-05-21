<?php

namespace Tests\Feature\Livewire;

use App\Livewire\PublicOrderForm;
use App\Models\Platform;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class PublicOrderFormTest extends TestCase
{
    use RefreshDatabase;

    public function test_renders_successfully()
    {
        Livewire::test(PublicOrderForm::class)
            ->assertStatus(200);
    }

    public function test_can_submit_order()
    {
        $platform = Platform::create(['name' => 'Tokopedia']);

        Livewire::test(PublicOrderForm::class)
            ->set('nama_barang', 'Barang Test')
            ->set('no_order', 'ORD-123')
            ->set('nomor_va', 'VA-123456')
            ->set('qty', 2)
            ->set('harga', 50000)
            ->set('platform', $platform->name)
            ->call('submit')
            ->assertHasNoErrors()
            ->assertSee('Data pesanan berhasil disimpan');

        $this->assertDatabaseHas('orders', [
            'no_order' => 'ORD-123',
            'nama_barang' => 'Barang Test',
            'platform' => $platform->name,
        ]);
    }

    public function test_validates_required_fields()
    {
        Livewire::test(PublicOrderForm::class)
            ->set('qty', '') // Override default qty=1
            ->call('submit')
            ->assertHasErrors([
                'nama_barang' => 'required',
                'no_order' => 'required',
                'qty' => 'required',
                'harga' => 'required',
                'platform' => 'required',
            ]);
    }
}
