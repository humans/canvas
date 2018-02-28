<?php

namespace App\Http\Controllers\Api;

use App\ConfirmationCode;

class ConfirmationCodesController extends Controller
{
    public function store()
    {
        ConfirmationCode::create(['email' => request('email')]);

        return response(['response' => true], 201);
    }
}