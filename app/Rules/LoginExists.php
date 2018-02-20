<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\User;

class LoginExists implements Rule
{
    public function passes($attribute, $login)
    {
        if (! is_email($login)) {
            return User::where('username', $login)->exists();
        }

        return User::where('email', $login)->exists();
    }

    public function message()
    {
        return __('validation.custom.login.exists', [
            'login' => login_field(),
        ]);
    }
}

