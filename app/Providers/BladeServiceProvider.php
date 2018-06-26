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

        Blade::if('local', function () {
            return app()->environment('local');
        });

        Blade::directive('partial', function ($expression) {
            $expression = strrev(str_replace('.', '_.', strrev($expression)));

            return "<?php echo \$__env->make({$expression}, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>";
        });
    }

    public function register()
    {
    }
}
