<?php

namespace App;

use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmationCode as ConfirmationCodeMail;

class ConfirmationCode extends Model
{
    const EMAIL = 'e';

    public static function to()
    {
        return request()->cookie(static::EMAIL);
    }

    public static function whisper()
    {
        return static::where(['email' => static::to()])->first()->code;
    }

    public static function boot()
    {
        static::creating(function ($model) {
            $model->code = sprintf("%06d", mt_rand(1, 999999));
        });

        static::created(function ($model) {
            cookie()->queue(
                cookie(static::EMAIL, $model->email, 60)
            );
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