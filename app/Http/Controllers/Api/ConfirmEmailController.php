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

        if (! $code->exists()) {
            return response([
                'message' => "The confirmation code was incorrect."
            ], 422);
        }


        return ['message' => 'Your email address has been confirmed.'];
    }
}