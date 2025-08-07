<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        return Location::all();
    }

    public function show(Location $location)
    {
        return $location;
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'name' => 'required|string|max:255',
            'address' => 'required|string',
        ]);
        $location = Location::create($data);
        return response()->json($location, 201);
    }

    public function update(Request $request, Location $location)
    {
        $data = $request->validate([
            'client_id' => 'sometimes|exists:clients,id',
            'name' => 'sometimes|string|max:255',
            'address' => 'sometimes|string',
        ]);
        $location->update($data);
        return $location;
    }

    public function destroy(Location $location)
    {
        $location->delete();
        return response()->noContent();
    }
}
