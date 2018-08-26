<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Concerns\HasFactories;
use App\Concerns\User\ImpersonatesUsers;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens,
        HasFactories, ImpersonatesUsers;

    protected $guarded = [];

    protected $hidden = [
        'password', 'remember_token'
    ];

    protected $casts = [
        'is_admin' => 'boolean',
    ];

    public function isAdmin()
    {
        return $this->is_admin;
    }
}
