<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;
use App\Models\Location;
use App\Models\Order;
use App\Models\Schedule;
use App\Models\User;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'client@example.com')->first();

        if (! $user) {
            $user = User::factory()->create([
                'name' => 'Client User',
                'email' => 'client@example.com',
            ]);
        }

        $client = Client::create([
            'name' => 'Acme Corp',
        ]);

        $client->users()->attach($user);

        $hq = $client->locations()->create([
            'name' => 'Headquarters',
            'address' => '123 Main St',
        ]);

        $order = $client->orders()->create([
            'location_id' => $hq->id,
            'description' => 'Sample Order',
            'status' => 'pending',
        ]);

        $client->schedules()->create([
            'order_id' => $order->id,
            'scheduled_at' => now()->addWeek(),
        ]);
    }
}
