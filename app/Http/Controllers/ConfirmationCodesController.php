<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
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
            'email' => ['required', 'email', Rule::unique('users')],
        ]);

        $code = ConfirmationCode::firstOrCreate($email)->send();

        return redirect()
            ->route('register')
            ->cookie(ConfirmationCode::EMAIL, $code->email, 60);
    }
}