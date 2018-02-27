<?php

namespace App\Http\Controllers\Admin;

class UsersController extends Controller
{
    public function index()
    {
        return view('admin.users.index');
    }
}