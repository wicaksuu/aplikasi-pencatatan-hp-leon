<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExportTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_export_routes()
    {
        $this->get(route('admin.export.excel'))->assertRedirect('/login');
        $this->get(route('admin.export.pdf'))->assertRedirect('/login');
    }

    public function test_admin_can_download_excel()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('admin.export.excel'));

        $response->assertStatus(200);
        $response->assertHeader('Content-Disposition');
    }

    public function test_admin_can_download_pdf()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('admin.export.pdf'));

        $response->assertStatus(200);
        $response->assertHeader('Content-Disposition');
    }
}
