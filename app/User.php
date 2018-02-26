<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Mail;
use App\Mail\Activation;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, HasFactories;

    protected $guarded = [];
    protected $hidden  = ['password', 'remember_token'];

    public function login()
    {
        auth()->login($this);

        return $this;
    }

    public function sendActivationMail()
    {
        Mail::to($this->email)->send(new Activation);

        return $this;
    }
}
