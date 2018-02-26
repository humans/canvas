<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;

class BladeServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function boot()
    {
        Blade::withoutDoubleEncoding();

        Blade::component('components.fields.text', 'textfield');
        Blade::component('components.fields.text', 'passwordfield');
    }

    public function register()
    {
    }
}