<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class SimpleNotification extends Notification
{
    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'This is a test notification.',
        ];
    }
}
