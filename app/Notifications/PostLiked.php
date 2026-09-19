<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class PostLiked extends Notification
{
    private $user;

    private $post;

    public function __construct($user, $post)
    {
        $this->user = $user;
        $this->post = $post;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        Log::info('Sending notification', [
            'user_id' => $this->user->id,
            'post_title' => $this->post->title,
            'post_id' => $this->post->id,
        ]);

        return [
            'message' => $this->user->id === $this->post->user_id
                ? 'You liked your own post: '.$this->post->title
                : $this->user->name.' liked your post: '.$this->post->title,
            'post_id' => $this->post->id,
            'user_id' => $this->user->id,
            'post_title' => $this->post->title,
            'user_name' => $this->user->name,
        ];
    }
}
