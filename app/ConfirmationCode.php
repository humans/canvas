<?php

namespace App;

use Illuminate\Support\Facades\Mail;
use App\Mail\EmailConfirmation;

class ConfirmationCode extends Model
{
    public static function boot()
    {
        static::creating(function ($model) {
            $model->code = sprintf("%06d", mt_rand(1, 999999));
        });
    }

    public function send()
    {
        Mail::to($this->email)->queue(new EmailConfirmation($this->code));
    }
}