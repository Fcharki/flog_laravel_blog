<?php

namespace App\Events;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Queue\SerializesModels;

class PostLiked
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $post;

    public function __construct($user, $post)
    {
        $this->user = $user;
        $this->post = $post;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('user.' . $this->post->user_id);
    }

    public function broadcastAs()
    {
        return 'PostLiked';
    }
}
