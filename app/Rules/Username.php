<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Username implements Rule
{
    public function passes($attribute, $username)
    {
        return preg_match('/^[a-zA-Z][a-zA-Z0-9\.\_]+/', $username);
    }

    public function message()
    {
        return __('validation.custom.username');
    }
}
