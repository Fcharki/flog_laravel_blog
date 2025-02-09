<?php


namespace App\Listeners;
use Illuminate\Support\Facades\Log;
use App\Events\ReviewCreated;
use App\Notifications\ReviewAdded;
use Illuminate\Support\Facades\Notification;
use Illuminate\Contracts\Queue\ShouldQueue; //  handles the event asynchronously
use Illuminate\Queue\InteractsWithQueue;

class SendReviewNotification implements ShouldQueue
{
    use InteractsWithQueue;
    public function handle(ReviewCreated $event)
    {
        Log::info('Notification triggered for review ID: ' . $event->review->id);
        // Send notification to the post author
        $event->review->post->user->notify(new ReviewAdded($event->review));
    }
}