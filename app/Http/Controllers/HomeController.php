<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function __invoke()
    {
        if (auth()->guest()) {
            return view('landing');
        }

        return view('home');
    }
}
