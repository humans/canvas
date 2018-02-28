<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Mail;
use App\ConfirmationCode;
use App\Mail\EmailConfirmation;

class ConfirmationCodesController extends Controller
{
    public function store()
    {
        $code = ConfirmationCode::create([
            'email' => request('email'),
        ]);

        Mail::to($code->email)->queue(new EmailConfirmation($code->code));

        return response(['response' => true], 201);
    }
}