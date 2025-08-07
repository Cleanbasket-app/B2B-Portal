<?php

namespace App\Livewire;

use App\Models\Location;
use App\Models\Order;
use App\Models\Schedule;
use App\Models\User;
use Livewire\Component;

class AdminDashboardLivewireComponent extends Component
{
    public int $ordersCount;
    public int $schedulesCount;
    public int $locationsCount;
    public int $teamCount;

    public function mount(): void
    {
        $this->ordersCount = Order::count();
        $this->schedulesCount = Schedule::count();
        $this->locationsCount = Location::count();
        $this->teamCount = User::count();
    }

    public function render()
    {
        return view('admin.dashboard');
    }
}

