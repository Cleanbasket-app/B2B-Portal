<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return Order::with(['client','location','schedule'])->get();
    }

    public function show(Order $order)
    {
        return $order->load(['client','location','schedule']);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'location_id' => 'required|exists:locations,id',
            'description' => 'required|string',
            'status' => 'required|string|max:255',
        ]);
        $order = Order::create($data);
        return response()->json($order->load(['client','location','schedule']), 201);
    }

    public function update(Request $request, Order $order)
    {
        $data = $request->validate([
            'client_id' => 'sometimes|exists:clients,id',
            'location_id' => 'sometimes|exists:locations,id',
            'description' => 'sometimes|string',
            'status' => 'sometimes|string|max:255',
        ]);
        $order->update($data);
        return $order->load(['client','location','schedule']);
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return response()->noContent();
    }
}
