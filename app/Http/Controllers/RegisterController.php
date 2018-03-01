<?php

namespace App\Http\Controllers;

use App\Rules\Username;
use App\ConfirmationCode;
use App\User;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->only('create', 'store');
    }

    public function create()
    {
        if (! $email = request()->cookie(ConfirmationCode::EMAIL)) {
            return redirect()->route('confirmation-codes.create');
        }

        $code = ConfirmationCode::where('email', $email)->first();

        return view('register.create', [
            'email' => $email,
            'code'  => $code->code,
        ]);
    }

    public function store()
    {
        request()->validate([
            'name'     => 'required',
            'username' => ['required', new Username],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $user = User::create($this->request())
              ->sendWelcomeMail()
              ->login();

        return redirect()->route('home');
    }

    private function request()
    {
        return [
            'name'     => request('name'),
            'username' => request('username'),
            'email'    => request()->cookie(ConfirmationCode::EMAIL),
            'password' => bcrypt(request('password')),
        ];
    }
}
