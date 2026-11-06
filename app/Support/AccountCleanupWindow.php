<?php

namespace App\Support;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

final class AccountCleanupWindow
{
    public const STARTED_AT_KEY = 'flog:inactive-account-cleanup-started-at';

    public const PRUNE_LOCK_KEY = 'flog:inactive-account-prune-lock';

    public static function start(): Carbon
    {
        $startedAt = Cache::rememberForever(
            self::STARTED_AT_KEY,
            fn () => now()->toIso8601String()
        );

        return Carbon::parse($startedAt);
    }
}
