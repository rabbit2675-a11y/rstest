<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_page_is_displayed(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/dashboard');

        $response->assertOk();
    }

    public function test_dashboard_view_renders_without_users_variable(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->view('dashboard', []);

        $response->assertSee('Benutzerliste');
        $response->assertSee('Keine Benutzer gefunden.');
    }
}
