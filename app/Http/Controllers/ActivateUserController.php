<?php

namespace App\Http\Controllers;

use App\User;

class ActivateUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function __invoke()
    {
        request()->validate(['token' => 'required']);

        User::byActivationToken(request('token'))
            ->activate()
            ->sendWelcomeMail();

        return redirect()->route('login');
    }
}
