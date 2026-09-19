<?php

namespace App\Providers;

use App\Events\ReplyCreated;
use App\Events\ReviewCreated;
use App\Listeners\SendReplyNotification;
use App\Listeners\SendReviewNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
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
