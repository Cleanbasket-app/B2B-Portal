<?php

namespace App\Livewire;

use App\Models\Location;
use App\Models\Order;
use App\Models\Schedule;
use App\Models\User;
use Livewire\Component;

class ClientDashboardLivewireComponent extends Component
{
    public int $ordersCount;
    public int $schedulesCount;
    public int $locationsCount;
    public int $teamCount;

    public function mount(): void
    {
        $clientIds = auth()->user()->clients()->pluck('clients.id');

        $this->ordersCount = Order::whereIn('client_id', $clientIds)->count();
        $this->schedulesCount = Schedule::whereIn('client_id', $clientIds)->count();
        $this->locationsCount = Location::whereIn('client_id', $clientIds)->count();
        $this->teamCount = User::whereHas('clients', function ($query) use ($clientIds) {
            $query->whereIn('client_id', $clientIds);
        })->count();
    }

    public function render()
    {
        return view('client.dashboard');
    }
}

