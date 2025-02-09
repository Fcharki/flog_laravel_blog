<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\PostLiked;
use App\Listeners\BroadcastPostLiked;
use App\Events\ReviewCreated;
use App\Events\ReplyCreated;
use App\Listeners\SendReviewNotification;
use App\Listeners\SendReplyNotification;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        PostLiked::class => [
            BroadcastPostLiked::class,
        ],
        ReviewCreated::class => [
            SendReviewNotification::class,
        ],
        ReplyCreated::class => [
            SendReplyNotification::class,
        ],
    ];

    public function boot()
    {
        parent::boot();

        // Other boot methods
    }
}
