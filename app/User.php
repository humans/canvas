<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Mail;
use App\Mail\Activation;
use App\Mail\Welcome;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, HasFactories;

    protected $guarded = [];
    protected $hidden  = ['password', 'remember_token'];

    public function scopeInactive($query)
    {
        $query->whereNotNull('activation_token');
    }

    public function scopeByActivationToken($query, $token)
    {
        return $query->where('activation_token', $token)->firstOrFail();
    }

    public function activate()
    {
        return tap($this)->update([
            'activated_at'     => now(),
            'activation_token' => null,
        ]);
    }

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

    public function sendWelcomeMail()
    {
        Mail::to($this->email)->queue(new Welcome);

        return $this;
    }
}
