<?php

namespace App\Http\Controllers\Api;

use App\ConfirmationCode;

class ConfirmationCodesController extends Controller
{
    public function store()
    {
        ConfirmationCode::fromEmail(request('email'))->send();

        return response(['response' => true], 201);
    }
}