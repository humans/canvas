<?php

namespace App\Http\Controllers\Admin;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return view('admin.dashboard');
    }
}
