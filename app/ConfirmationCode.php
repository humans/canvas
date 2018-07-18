<?php

namespace App;

use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmationCode as ConfirmationCodeMail;

class ConfirmationCode extends Model
{
    const EMAIL = 'e';

    protected $casts = [
        'expires_at' => 'datetime',
    ];

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
            $model->code       = sprintf("%06d", mt_rand(1, 999999));
            $model->expires_at = now()->addHours(1);
        });
    }

    public function isExpired()
    {
        return now()->gt($this->expires_at);
    }

    public function refreshCookie()
    {
        cookie()->queue(
            cookie(static::EMAIL, $this->email, $minutes = 60)
        );

        return $this;
    }

    public function resetIfExpired()
    {
        if (! $this->isExpired()) {
            return $this;
        }

        return tap($this)->update([
            'code'       => sprintf("%06d", mt_rand(1, 999999)),
            'expires_at' => now()->addHours(1),
        ]);
    }

    public function send()
    {
        Mail::to($this->email)->queue(
            new ConfirmationCodeMail($this->code)
        );

        return $this;
    }
}
