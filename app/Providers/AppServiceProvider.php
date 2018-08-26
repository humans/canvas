<?php

namespace App\Providers;

use Laravel\Horizon\Horizon;
use Laravel\Dusk\DuskServiceProvider;
use App\Http\Controllers\ActivateUserController;

class AppServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function boot()
    {
        require_once app_path('helpers.php');

        Horizon::auth(function ($request) {
            return optional($request->user())->isAdmin();
        });
    }

    public function register()
    {
        if ($this->app->environment('local', 'testing')) {
            $this->app->register(DuskServiceProvider::class);
        }
    }
}
