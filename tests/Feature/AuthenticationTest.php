<?php

namespace Tests\Feature;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_login_redirects_to_admin_dashboard(): void
    {
        $admin = User::factory()->create([
            'role' => UserRole::Admin,
            'password' => bcrypt('password'),
        ]);

        $response = $this->post('/login', [
            'email' => $admin->email,
            'password' => 'password',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticatedAs($admin);
    }

    public function test_client_login_redirects_to_client_dashboard(): void
    {
        $client = User::factory()->create([
            'role' => UserRole::Client,
            'password' => bcrypt('password'),
        ]);

        $response = $this->post('/login', [
            'email' => $client->email,
            'password' => 'password',
        ]);

        $response->assertRedirect(route('client.dashboard'));
        $this->assertAuthenticatedAs($client);
    }

    public function test_client_cannot_access_admin_dashboard(): void
    {
        $client = User::factory()->create([
            'role' => UserRole::Client,
        ]);

        $this->actingAs($client);

        $response = $this->get(route('admin.dashboard'));

        $response->assertForbidden();
    }

    public function test_admin_cannot_access_client_dashboard(): void
    {
        $admin = User::factory()->create([
            'role' => UserRole::Admin,
        ]);

        $this->actingAs($admin);

        $response = $this->get(route('client.dashboard'));

        $response->assertForbidden();
    }

    public function test_guest_is_redirected_to_login_when_accessing_admin_dashboard(): void
    {
        $response = $this->get(route('admin.dashboard'));

        $response->assertRedirect(route('login'));
    }
}

