<?php

namespace App\Http\Controllers;

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
        request()->validate([
            'login'    => ['required', new LoginExists],
            'password' => 'required',
        ]);

        if (! auth()->attempt($this->credentials($request), true)) {
            return redirect()->back()->with('error', 'Incorrect username or password.');
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

    /**
     * Get the credentials.
     *
     * @return array
     */
    private function credentials()
    {
        $field = is_email(request('login')) ? 'email' : 'username';

        return [
            $field     => request('login'),
            'password' => request('password'),
        ];
    }
}