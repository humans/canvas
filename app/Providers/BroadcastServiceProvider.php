<?php

namespace App\Providers;

use Illuminate\Support\Facades\Broadcast;

class BroadcastServiceProvider extends Illuminate\Support\ServiceProvider
{
    public function boot()
    {
        Broadcast::routes();

        require base_path('routes/channels.php');
    }
}
