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
        ], [
            'email.unique' => "The email is already a registered account."
        ]);

        ConfirmationCode::firstOrCreate($email)
            ->resetIfExpired()
            ->refreshCookie()
            ->send();

        return redirect()->route('register');
    }
}
