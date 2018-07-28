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

        static::created(function ($model) {
            cookie()->queue(
                cookie(static::EMAIL, $model->email, 60)
            );
        });
    }

    public function isExpired()
    {
        return $this->expires_at->lte(now());
    }

    public function resetIfExpired()
    {
        if (! $this->isExpired()) {
            return $this;
        }

        return tap($this)->update([
            'code' => sprintf("%06d", mt_rand(1, 999999)),
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
