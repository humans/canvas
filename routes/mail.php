<?php

use App\Mail\Activation;
use App\Mail\Welcome;
use App\User;

Route::get('activate', function () {
    return new Activation(User::first());
});

Route::get('welcome', function () {
    return new Welcome(User::first());
});