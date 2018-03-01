<?php

namespace App;

use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmationCode as ConfirmationCodeMail;

class ConfirmationCode extends Model
{
    const TIMESTAMP = 'e-ts';
    const EMAIL     = 'e';

    public static function boot()
    {
        static::creating(function ($model) {
            $model->code = sprintf("%06d", mt_rand(1, 999999));
        });
    }

    public function send()
    {
        Mail::to($this->email)->queue(
            new ConfirmationCodeMail($this->code)
        );

        return $this;
    }
}