<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        return Client::all();
    }

    public function show(Client $client)
    {
        return $client;
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $client = Client::create($data);
        return response()->json($client, 201);
    }

    public function update(Request $request, Client $client)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $client->update($data);
        return $client;
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return response()->noContent();
    }
}
