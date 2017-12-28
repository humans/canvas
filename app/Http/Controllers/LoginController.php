<?php

namespace App\Http\Controllers;

use App\Rules\LoginExists;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('destroy');
    }

    public function create()
    {
        return view('login.create');
    }

    public function store()
    {
        $credentials = request()->validate([
            'email'    => ['required', 'exists:users'],
            'password' => 'required',
        ]);

        if (! auth()->attempt($credentials, true)) {
            return back()->with('error', __('auth.failed'));
        }

        return redirect()->intended(route('home'));
    }

    public function destroy()
    {
        auth()->logout();

        return redirect()->route('home');
    }
}
