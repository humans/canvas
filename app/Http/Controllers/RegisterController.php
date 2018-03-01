<?php

namespace App\Http\Controllers;

use App\Http\Middleware\EmailConfirmed;
use App\Http\Requests\RegisterRequest;
use App\ConfirmationCode;
use App\User;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest', EmailConfirmed::class]);
    }

    public function create()
    {
        return view('register.create', [
            'email' => ConfirmationCode::to()
        ]);
    }

    public function store(RegisterRequest $request)
    {
        User::create($request->data())
            ->login()
            ->sendWelcomeMail()
            ->deleteConfirmationCode();

        return redirect()->route('home');
    }
}
