<?php

namespace App\Http\Controllers;

use App\Rules\LoginExists;

class LoginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return LoginController
     */
    public function __construct()
    {
        $this->middleware('guest')->except('destroy');
    }

    /**
     * Show the login form.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('login.create');
    }

    /**
     * Attempt to log the user in.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * Log the user out.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy()
    {
        auth()->logout();

        return redirect()->route('home');
    }
}