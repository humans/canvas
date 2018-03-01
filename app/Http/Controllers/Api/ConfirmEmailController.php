<?php

namespace App\Http\Controllers\Api;

use App\ConfirmationCode;

class ConfirmEmailController extends Controller
{
    public function __invoke()
    {
        $code = ConfirmationCode::where(request([
            'email', 'code'
        ]));

        return ['response' => $code->exists()];
    }
}