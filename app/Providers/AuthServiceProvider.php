<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends \Illuminate\Foundation\Support\Providers\AuthServiceProvider
{
    protected $policies = [
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
