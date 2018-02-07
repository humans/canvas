<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        require_once app_path('helpers.php');

        Blade::withoutDoubleEncoding();

        view()->composer('*', function ($view) {
            $view->with('me', auth()->user());
        });
    }

    public function register()
    {
    }
}
