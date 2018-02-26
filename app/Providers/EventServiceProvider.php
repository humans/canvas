<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;

class EventServiceProvider extends \Illuminate\Foundation\Support\Providers\EventServiceProvider
{
    protected $listen = [];

    public function boot()
    {
        parent::boot();
    }
}
