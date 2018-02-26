<?php

namespace App\Http\Requests;

abstract class FormRequest extends \Illuminate\Foundation\Http\FormRequest
{
    protected function passesAuthorization()
    {
        if (method_exists($this, 'authorize')) {
            return $this->authorize();
        }

        return true;
    }
}
