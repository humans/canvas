<?php

namespace App;

trait ImpersonatesUsers
{
    public function canImpersonate()
    {
        return $this->is_admin;
    }

    public function canBeImpersonated()
    {
        return ! $this->is_admin;
    }

    public function isImpersonated()
    {
        return app('impersonate')->isImpersonating();
    }
}