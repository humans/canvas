<?php

namespace App\Http\Requests;

use App\Rules\LoginExists;

class LoginRequest extends FormRequest
{
    public function rules()
    {
        return [
            'login'    => ['required', new LoginExists],
            'password' => 'required',
        ];
    }

    public function credentials()
    {
        return [
            login_field() => $this->login,
            'password'    => $this->password,
        ];
    }
}
