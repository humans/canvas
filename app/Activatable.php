<?php

namespace App;

use Illuminate\Support\Facades\Mail;
use App\Mail\Activation;
use App\Mail\Welcome;

trait Activatable
{
    public function setEmailAttribute($email)
    {
        $this->attributes['email']            = $email;
        $this->attributes['activation_token'] = sha1(uniqid(mt_rand(), true) . $email);
    }

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

    public function sendActivationMail()
    {
        Mail::to($this->email)->send(new Activation($this));

        return $this;
    }

    public function sendWelcomeMail()
    {
        Mail::to($this->email)->queue(new Welcome($this));

        return $this;
    }
}