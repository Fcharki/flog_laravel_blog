<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Support\AccountCleanupWindow;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class TrackAndPurgeInactiveAccounts
{
    public function handle(Request $request, Closure $next): Response
    {
        $cleanupStartedAt = AccountCleanupWindow::start();
        $response = $next($request);

        try {
            $user = $request->user();

            if (
                $user
                && ! str_ends_with($user->email, '@example.invalid')
                && $user->created_at?->greaterThanOrEqualTo($cleanupStartedAt)
                && $user->updated_at?->lessThanOrEqualTo(now()->subDay())
            ) {
                DB::table('users')
                    ->where('id', $user->getKey())
                    ->where('created_at', '>=', $cleanupStartedAt)
                    ->where('updated_at', '<=', now()->subDay())
                    ->update(['updated_at' => now()]);
            }

            if (Cache::add(AccountCleanupWindow::PRUNE_LOCK_KEY, true, now()->addDay())) {
                try {
                    $expiredUserIds = User::query()
                        ->where('created_at', '>=', $cleanupStartedAt)
                        ->where('updated_at', '<=', now()->subDays(3))
                        ->where('email', 'not like', '%@example.invalid')
                        ->pluck('id');

                    if ($expiredUserIds->isNotEmpty()) {
                        DB::table(config('session.table', 'sessions'))
                            ->whereIn('user_id', $expiredUserIds)
                            ->delete();

                        User::query()->whereIn('id', $expiredUserIds)->delete();
                    }
                } catch (Throwable $exception) {
                    Cache::forget(AccountCleanupWindow::PRUNE_LOCK_KEY);
                    throw $exception;
                }
            }
        } catch (Throwable $exception) {
            report($exception);
        }

        return $response;
    }
}
