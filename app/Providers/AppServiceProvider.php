<?php

namespace App\Providers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share the categories split with EVERY view that includes the
        // public header (home, about, help, post show + category pages).
        // This removes the need for every controller to pass
        // $visibleCategories / $hiddenCategories by hand.
        View::composer('*', function ($view) {

            $view->with(
                'showNavbarCategories',
                ! in_array($view->getName(), ['about', 'help'], true)
            );

            if ($view->offsetExists('visibleCategories') || $view->offsetExists('hiddenCategories')) {
                return;
            }

            $categories = Cache::remember('navbar.categories', now()->addHour(), function () {
                return DB::table('categories')
                    ->select('id', 'category_name as name')
                    ->get();
            });

            $view->with('visibleCategories', $categories->take(10));
            $view->with('hiddenCategories', $categories->slice(10));
        });
    }
}
