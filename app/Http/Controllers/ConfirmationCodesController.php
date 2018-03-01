<?php

namespace App\Http\Controllers;

use App\ConfirmationCode;

class ConfirmationCodesController extends Controller
{
    public function store()
    {
        $email = request()->validate([
            'email' => 'required'
        ]);

        ConfirmationCode::create($email)->send();

        return response(['response' => true], 201);
    }
}