<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $guarded = [];
    protected $hidden  = ['password', 'remember_token'];

    public function login()
    {
        auth()->login($this);

        return $this;
    }
}
