<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;

class BladeServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function boot()
    {
        Blade::withoutDoubleEncoding();

        Blade::include('components.fields.text', 'textfield');
        Blade::include('components.fields.password', 'passwordfield');
        Blade::include('components.errors', 'errors');
    }

    public function register()
    {
    }
}