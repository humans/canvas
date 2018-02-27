<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\User;

class EmailConfirmationController extends Controller
{
    public function __invoke()
    {
        return view('users.confirm-email');
    }
}