<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ActivityLog;

class AdminActivityLogsLivewireComponent extends Component
{
    public function render()
    {
        $logs = ActivityLog::with('user')->latest()->get();

        return view('admin.activity-logs', ['logs' => $logs]);
    }
}

