<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\Welcome;
use App\User;

class ActivateUserController extends Controller
{
    public function __invoke()
    {
        request()->validate([
            'token' => 'required',
        ]);

        $user = tap($this->user())->update([
            'activated_at'     => now(),
            'activation_token' => null,
        ]);

        Mail::to($user->email)->queue(new Welcome);

        return redirect()->route('login');
    }

    private function user()
    {
        return User::where('activation_token', request('token'))->first();
    }
}
