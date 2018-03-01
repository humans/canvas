<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Mail;
use App\Mail\Welcome;

class User extends Authenticatable
{
    use Notifiable, Activatable, ImpersonatesUsers, HasApiTokens, HasFactories;

    protected $guarded = [];

    protected $hidden = [
        'password', 'remember_token'
    ];

    protected $casts = [
        'is_admin' => 'boolean',
    ];

    public function removeConfirmationCode()
    {
        ConfirmationCode::where('email', $this->email)->delete();

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
