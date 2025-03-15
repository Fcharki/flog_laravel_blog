<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Log;
class ReviewAdded extends Notification
{
    use Queueable;

    protected $review;

    public function __construct($review)
    {
        $this->review = $review;
    }

    public function via($notifiable)
    {
        return ['database', 'mail']; // Notify via database and email
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('A new review has been added to your post.')
                    ->action('View Review', url('/posts/'.$this->review->post_id))
                    ->line('Thank you for using our application!');
    }

    public function toArray($notifiable)
    {
        $data = [
            'review_id' => $this->review->id,
            'post_id' => $this->review->post->id,
            'message' => 'A new review was added to your post.',
        ];

        Log::info('Notification payload: ', $data);

        return $data;
    }
}
