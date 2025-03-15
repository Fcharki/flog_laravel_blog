<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\User;

Broadcast::channel('post-liked.{userId}', function (User $user, $userId) {
    return (int) $user->id === (int) $userId;
});
