<?php

namespace App\Listeners;

use App\Events\ReplyCreated;
use App\Notifications\ReviewReplied;
use Illuminate\Support\Facades\Notification;
use Illuminate\Contracts\Queue\ShouldQueue; //  handles the event asynchronously
use Illuminate\Queue\InteractsWithQueue;
//* The InteractsWithQueue trait in Laravel is used to 
// provide some convenient methods for interacting with a
// queued job. It is typically used within classes 
// that implement the ShouldQueue interface

class SendReplyNotification  implements ShouldQueue
{
    use InteractsWithQueue;
    public function handle(ReplyCreated $event)
    {
        // Send notification to the review author
        $event->reply->review->user->notify(new ReviewReplied($event->reply));
    }
}