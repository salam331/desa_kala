<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\WelcomeElement;

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
        // Share welcome elements to all views
        View::composer('*', function ($view) {
            $welcomeElements = WelcomeElement::all()->groupBy('element_type');
            $view->with('welcomeElements', $welcomeElements);
        });
    }
}
