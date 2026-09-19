<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
                !in_array($view->getName(), ['about', 'help'], true)
            );

            if ($view->offsetExists('visibleCategories') || $view->offsetExists('hiddenCategories')) {
                return;
            }

            $categories = DB::table('categories')
                ->select('id', 'category_name as name')
                ->get();

            $view->with('visibleCategories', $categories->take(10));
            $view->with('hiddenCategories', $categories->slice(10));
        });
    }
}
