<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ScheduleUpdated;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'order_id',
        'scheduled_at',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::updated(function (Schedule $schedule) {
            $notification = new ScheduleUpdated($schedule);
            Notification::send($schedule->client->users, $notification);

            if ($phone = config('services.vonage.test_number')) {
                Notification::route('vonage', $phone)->notify($notification);
            }
        });
    }

    /**
     * Get the client that owns the schedule.
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Get the order for the schedule.
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
