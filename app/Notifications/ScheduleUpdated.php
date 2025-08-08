<?php

namespace App\Notifications;

use App\Models\Schedule;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\VonageMessage;
use Illuminate\Notifications\Notification;

class ScheduleUpdated extends Notification
{
    use Queueable;

    public function __construct(public Schedule $schedule)
    {
        //
    }

    public function via(object $notifiable): array
    {
        return ['mail', 'vonage'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject(__('notifications.schedule_updated_subject', ['id' => $this->schedule->order_id]))
            ->line(__('notifications.schedule_updated_body', [
                'id' => $this->schedule->order_id,
                'date' => $this->schedule->scheduled_at->toDateTimeString(),
            ]));
    }

    public function toVonage(object $notifiable): VonageMessage
    {
        return (new VonageMessage)
            ->content(__('notifications.schedule_updated_sms', [
                'id' => $this->schedule->order_id,
                'date' => $this->schedule->scheduled_at->toDateTimeString(),
            ]));
    }
}
