<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\Reply;
use App\Models\Review;
use App\Policies\PostPolicy;
use App\Policies\ReplyPolicy;
use App\Policies\ReviewPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Post::class => PostPolicy::class,
        Review::class => ReviewPolicy::class,
        Reply::class => ReplyPolicy::class,

    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
