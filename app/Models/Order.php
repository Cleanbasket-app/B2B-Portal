<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Notification;
use App\Notifications\OrderCreated;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'location_id',
        'description',
        'status',
    ];

    protected static function booted(): void
    {
        static::created(function (Order $order) {
            $notification = new OrderCreated($order);
            Notification::send($order->client->users, $notification);

            if ($phone = config('services.vonage.test_number')) {
                Notification::route('vonage', $phone)->notify($notification);
            }
        });
    }

    /**
     * Get the client that owns the order.
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Get the location for the order.
     */
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * Get the schedule associated with the order.
     */
    public function schedule(): HasOne
    {
        return $this->hasOne(Schedule::class);
    }
}
