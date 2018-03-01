<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use App\Http\Requests\RegisterRequest;
use App\ConfirmationCode;
use App\User;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->only('create', 'store');
    }

    public function create()
    {
        if (! $email = request()->cookie(ConfirmationCode::EMAIL)) {
            return redirect()->route('confirmation-codes.create');
        }

        if(! $code = ConfirmationCode::where('email', $email)->first()) {
            return redirect()->route('confirmation-codes.create');
        }


        return view('register.create', [
            'email' => $email,
            'code'  => $code->code,
        ]);
    }

    public function store(RegisterRequest $request)
    {
        User::create($request->attributes())
            ->login()
            ->sendWelcomeMail()
            ->removeConfirmationCode();

        return redirect()
            ->route('home')
            ->cookie(cookie()->forget(ConfirmationCode::EMAIL));
    }
}
