<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        return Schedule::with(['client','order'])->get();
    }

    public function show(Schedule $schedule)
    {
        return $schedule->load(['client','order']);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'order_id' => 'required|exists:orders,id',
            'scheduled_at' => 'required|date',
        ]);
        $schedule = Schedule::create($data);
        return response()->json($schedule->load(['client','order']), 201);
    }

    public function update(Request $request, Schedule $schedule)
    {
        $data = $request->validate([
            'client_id' => 'sometimes|exists:clients,id',
            'order_id' => 'sometimes|exists:orders,id',
            'scheduled_at' => 'sometimes|date',
        ]);
        $schedule->update($data);
        return $schedule->load(['client','order']);
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return response()->noContent();
    }
}
