<?php

namespace Tests\Feature\Livewire;

use App\Livewire\AdminOrdersLivewireComponent;
use App\Livewire\ClientOrdersLivewireComponent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class OrdersComponentTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_orders_component_renders(): void
    {
        Livewire::test(AdminOrdersLivewireComponent::class)
            ->assertSee('Admin Orders Placeholder');
    }

    public function test_client_orders_component_renders(): void
    {
        Livewire::test(ClientOrdersLivewireComponent::class)
            ->assertSee('Client Orders Placeholder');
    }
}

