<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        require_once app_path('helpers.php');

        view()->composer('*', function ($view) {
            $view->with('me', auth()->user());
        });
    }

    public function register()
    {
    }
}
