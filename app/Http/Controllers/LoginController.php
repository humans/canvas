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
            'login'    => ['required', new LoginExists],
            'password' => 'required',
        ]);

        if (! auth()->attempt($this->credentials(), request('remember'))) {
            return back()->with('error', $this->loginFailedMessage());
        }

        return redirect()->intended(route('home'));
    }

    public function destroy()
    {
        auth()->logout();

        return redirect()->route('home');
    }

    private function credentials()
    {
        $field = is_email(request('login')) ? 'email' : 'username';

        return [
            $field     => request('login'),
            'password' => request('password'),
        ];
    }

    private function loginFailedMessage()
    {
        return __('auth.failed', [
            'field' => is_email(request('login')) ? 'email address' : 'username'
        ]);
    }
}
