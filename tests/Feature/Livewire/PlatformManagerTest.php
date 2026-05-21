<?php

namespace Tests\Feature\Livewire;

use App\Livewire\Admin\PlatformManager;
use App\Models\Platform;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class PlatformManagerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_platform()
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test(PlatformManager::class)
            ->set('name', 'Shopee')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('platforms', ['name' => 'Shopee']);
    }

    public function test_can_update_platform()
    {
        $user = User::factory()->create();
        $platform = Platform::create(['name' => 'Old Name']);

        Livewire::actingAs($user)
            ->test(PlatformManager::class)
            ->set('editingId', $platform->id)
            ->set('name', 'New Name')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('platforms', ['name' => 'New Name']);
    }

    public function test_can_delete_platform()
    {
        $user = User::factory()->create();
        $platform = Platform::create(['name' => 'To Delete']);

        Livewire::actingAs($user)
            ->test(PlatformManager::class)
            ->call('delete', $platform->id)
            ->assertHasNoErrors();

        $this->assertDatabaseMissing('platforms', ['id' => $platform->id]);
    }
}
