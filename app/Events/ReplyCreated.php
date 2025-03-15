<?php

namespace App\Events;

use App\Models\Reply;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReplyCreated implements ShouldQueue
{
    use Dispatchable, SerializesModels;

    public $reply;

    public function __construct(Reply $reply)
    {
        $this->reply = $reply;
    }
}