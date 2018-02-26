<?php

namespace App\Providers;

use Laravel\Dusk\DuskServiceProvider;

class AppServiceProvider extends \Illuminate\Support\ServiceProvider
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
        if ($this->app->environment('local', 'testing')) {
            $this->app->register(DuskServiceProvider::class);
        }
    }
}
