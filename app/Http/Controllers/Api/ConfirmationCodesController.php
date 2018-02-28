<?php

namespace App\Http\Controllers\Api;

use App\ConfirmationCode;

class ConfirmationCodesController extends Controller
{
    public function store()
    {
        ConfirmationCode::create([
            'email' => request('email'),
            'code'  => sprintf("%06d", mt_rand(1, 999999)),
        ]);

        return response(['response' => true], 201);
    }
}