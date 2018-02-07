<?php

namespace App;

trait HasFactories
{
    public static function factory()
    {
        return factory(static::class);
    }
}
