<?php

namespace App\Http\Controllers;

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
        request()->validate([
            'login'    => ['required', new LoginExists],
            'password' => 'required',
        ]);

        if (! auth()->attempt($this->credentials($request), true)) {
            return redirect()->back()->with('error', 'Incorrect username or password.');
        }

        return redirect()->intended(route('home'));
    }

    public function destroy()
    {
        auth()->logout();
    }

    private function credentials($request)
    {
        $field = is_email(request('login')) ? 'email' : 'username';

        return [
            $field     => request('login'),
            'password' => request('password'),
        ];
    }
}