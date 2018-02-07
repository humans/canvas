<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\User;

class LoginExists implements Rule
{
    public function passes($attribute, $value)
    {
        $this->field = is_email($value) ? 'email' : 'username';

        if (! is_email($value)) {
            return User::where('username', $value)->exists();
        }

        return User::where('email', $value)->exists();
    }

    public function message()
    {
        return __('validation.custom.login.exists', [
            'field' => $this->field,
        ]);
    }
}

