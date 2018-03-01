<?php

namespace App\Http\Controllers;

use App\ConfirmationCode;

class ConfirmationCodesController extends Controller
{
    public function create()
    {
        return view('confirmation-codes.create');
    }

    public function store()
    {
        $email = request()->validate([
            'email' => 'required'
        ]);

        $code = ConfirmationCode::firstOrCreate($email)->send();

        return redirect()
            ->route('register')
            ->cookie(ConfirmationCode::TIMESTAMP, now(), 60)
            ->cookie(ConfirmationCode::EMAIL, $code->email, 60);
    }
}