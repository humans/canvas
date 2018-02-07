<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

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
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        User::create($this->request())->sendActivationMail()->login();

        return redirect()->route('home');
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
