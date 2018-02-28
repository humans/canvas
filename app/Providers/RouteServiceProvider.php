<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends \Illuminate\Foundation\Support\Providers\RouteServiceProvider
{
    protected $namespace = 'App\Http\Controllers';

    public function boot()
    {
        //

        parent::boot();
    }

    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        $this->mapAdminRoutes();

        $this->mapMailRoutes();
    }

    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace . "\\Api")
             ->as('api.')
             ->group(base_path('routes/api.php'));
    }

    protected function mapAdminRoutes()
    {
        Route::prefix('admin')
            ->middleware('web', 'admin')
            ->namespace($this->namespace . '\Admin')
            ->as('admin.')
            ->group(base_path('routes/admin.php'));
    }

    protected function mapMailRoutes()
    {
        if (! $this->app->environment('local')) {
            return;
        }

        Route::prefix('mail')
            ->middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/mail.php'));
    }
}
