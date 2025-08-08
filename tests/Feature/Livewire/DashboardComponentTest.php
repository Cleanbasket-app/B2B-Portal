<?php

namespace Tests\Feature\Livewire;

use App\Enums\UserRole;
use App\Livewire\AdminDashboardLivewireComponent;
use App\Livewire\ClientDashboardLivewireComponent;
use App\Models\Client;
use App\Models\Location;
use App\Models\Order;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Livewire\Livewire;
use Tests\TestCase;

class DashboardComponentTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_dashboard_displays_counts(): void
    {
        Notification::fake();

        $admin = User::factory()->create(['role' => UserRole::Admin]);
        User::factory()->count(2)->create();

        $client = Client::create(['name' => 'Acme']);
        $location = Location::create([
            'client_id' => $client->id,
            'name' => 'HQ',
            'address' => '123 Street',
        ]);

        $order = Order::create([
            'client_id' => $client->id,
            'location_id' => $location->id,
            'description' => 'Test',
            'status' => 'new',
        ]);

        Schedule::create([
            'client_id' => $client->id,
            'order_id' => $order->id,
            'scheduled_at' => now(),
        ]);

        $this->actingAs($admin);

        Livewire::test(AdminDashboardLivewireComponent::class)
            ->assertSet('ordersCount', 1)
            ->assertSet('schedulesCount', 1)
            ->assertSet('locationsCount', 1)
            ->assertSet('teamCount', 3);
    }

    public function test_client_dashboard_displays_counts_for_authenticated_client(): void
    {
        Notification::fake();

        $client = Client::create(['name' => 'Acme']);

        $user = User::factory()->create(['role' => UserRole::Client]);
        $user->clients()->attach($client->id);

        $otherUser = User::factory()->create();
        $otherUser->clients()->attach($client->id);

        $location = Location::create([
            'client_id' => $client->id,
            'name' => 'HQ',
            'address' => '123 Street',
        ]);

        $order = Order::create([
            'client_id' => $client->id,
            'location_id' => $location->id,
            'description' => 'Test',
            'status' => 'new',
        ]);

        Schedule::create([
            'client_id' => $client->id,
            'order_id' => $order->id,
            'scheduled_at' => now(),
        ]);

        $this->actingAs($user);

        Livewire::test(ClientDashboardLivewireComponent::class)
            ->assertSet('ordersCount', 1)
            ->assertSet('schedulesCount', 1)
            ->assertSet('locationsCount', 1)
            ->assertSet('teamCount', 2);
    }
}

