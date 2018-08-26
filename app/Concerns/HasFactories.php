<?php

namespace App\Concerns;

trait HasFactories
{
    public static function factory(...$states)
    {
        return factory(static::class)->states($states);
    }
}
