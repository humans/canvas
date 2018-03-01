<?php

namespace App;

use Illuminate\Support\Facades\Mail;
use App\Mail\Welcome;

trait Activatable
{
    public function deleteConfirmationCode()
    {
        ConfirmationCode::where('email', $this->email)->delete();

        cookie()->queue(cookie()->forget(ConfirmationCode::EMAIL));

        return $this;
    }

    public function sendWelcomeMail()
    {
        Mail::to($this->email)->queue(new Welcome($this));

        return $this;
    }

    public function login()
    {
        auth()->login($this);

        return $this;
    }
}