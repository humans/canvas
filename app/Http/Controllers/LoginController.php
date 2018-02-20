<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;

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

    public function store(LoginRequest $request)
    {
        if (! $this->login($request->credentials())) {
            return back()->with('error', $this->failed());
        }

        return redirect()->intended(route('home'));
    }

    public function destroy()
    {
        auth()->logout();

        return redirect()->route('home');
    }

    private function login($credentials)
    {
        return auth()->attempt($credentials, request('remember'));
    }

    private function failed()
    {
        return __('auth.failed', ['field' => login_field()]);
    }
}
