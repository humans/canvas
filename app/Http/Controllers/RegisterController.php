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

        auth()->login(
            User::create($this->request())
        );

        return redirect()->route('home');
    }

    public function request()
    {
        return request(['name', 'email']) + [
            'password' => bcrypt(request('password'))
        ];
    }
}
