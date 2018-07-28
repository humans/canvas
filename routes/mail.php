<?php

use App\Mail\Welcome;
use App\Mail\ConfirmationCode as ConfirmationCodeMail;
use App\ConfirmationCode;
use App\User;

Route::get('welcome', function () {
    return new Welcome(User::first());
});

Route::get('confirmation-code', function () {
    $code = ConfirmationCode::firstOrCreate([
        'email' => 'jaggy@wip.design'
    ]);

    return new ConfirmationCodeMail($code->code);
});
