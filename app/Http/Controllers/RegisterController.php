<?php

namespace App\Http\Controllers;

use App\Rules\Username;
use App\User;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->only('create', 'store');
    }

    public function create()
    {
        return view('register.create');
    }

    public function store()
    {
        request()->validate([
            'name'     => 'required',
            'email'    => ['required', 'email'],
            'username' => ['required', new Username],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $user = User::create($this->request())->sendActivationMail();

        return redirect()->route('confirm-email', [
            'hash' => md5($user->email),
        ]);
    }

    private function request()
    {
        return [
            'name'     => request('name'),
            'username' => request('username'),
            'email'    => request('email'),
            'password' => bcrypt(request('password')),
        ];
    }
}
