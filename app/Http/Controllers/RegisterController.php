<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return LoginController
     */
    public function __construct()
    {
        $this->middleware('guest')->only('create', 'store');
    }

    /**
     * Show the registration form.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('register.create');
    }

    /**
     * Register the user.
     *
     * @return \Illuminate\View\View
     */
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

    /**
     * Get the request values and hash the password.
     *
     * @return array
     */
    public function request()
    {
        return request(['name', 'email']) + [
            'password' => bcrypt(request('password'))
        ];
    }
}
