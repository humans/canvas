<?php

namespace App;

trait ImpersonatesUsers
{
    public function canImpersonate()
    {
        return $this->isAdmin();
    }

    public function canBeImpersonated()
    {
        return ! $this->isAdmin();
    }

    public function isImpersonated()
    {
        return app('impersonate')->isImpersonating();
    }
}
