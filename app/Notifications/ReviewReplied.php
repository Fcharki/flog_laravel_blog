<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ReviewReplied extends Notification
{
    use Queueable;

    protected $reply;

    public function __construct($reply)
    {
        $this->reply = $reply;
    }

    public function via($notifiable)
    {
        return ['database', 'mail']; // Notify via database and email
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('Someone replied to your review.')
                    ->action('View Reply', url('/posts/'.$this->reply->review->post_id))
                    ->line('Thank you for using our application!');
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'Someone replied to your review.',
            'reply_id' => $this->reply->id,
            'review_id' => $this->reply->review_id,
            'post_id' => $this->reply->review->post_id,
        ];
    }
}
