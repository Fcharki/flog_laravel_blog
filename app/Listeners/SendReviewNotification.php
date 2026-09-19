<?php

namespace App\Listeners;

use App\Events\ReviewCreated;
use App\Notifications\ReviewAdded;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SendReviewNotification implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(ReviewCreated $event)
    {
        Log::info('Notification triggered for review ID: '.$event->review->id);
        // Send notification to the post author
        $event->review->post->user->notify(new ReviewAdded($event->review));
    }
}
