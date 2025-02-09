<?php

namespace App\Listeners;

use App\Events\PostLiked;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class BroadcastPostLiked implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(PostLiked $event)
    {
        broadcast($event);
    }
}
