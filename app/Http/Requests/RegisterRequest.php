<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Rules\Username;
use App\ConfirmationCode;

class RegisterRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name'     => 'required',
            'email'    => Rule::unique('users'),
            'username' => ['required', Rule::unique('users'), new Username],
            'password' => ['required', 'confirmed', 'min:8'],
        ];
    }

    public function validationData()
    {
        return $this->merge([
            'email' => $this->cookie(ConfirmationCode::EMAIL)
        ])->all();
    }

    public function attributes()
    {
        return [
            'name'     => $this->name,
            'username' => $this->username,
            'email'    => $this->cookie(ConfirmationCode::EMAIL),
            'password' => bcrypt($this->password),
        ];
    }
}
