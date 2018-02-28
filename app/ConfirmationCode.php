<?php

namespace App;

class ConfirmationCode extends Model
{
    public static function boot()
    {
        static::creating(function ($model) {
            $model->code = sprintf("%06d", mt_rand(1, 999999));
        });
    }
}