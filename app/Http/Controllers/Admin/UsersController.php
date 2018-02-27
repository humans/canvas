<?php

namespace App\Http\Controllers\Admin;

use App\User;

class UsersController extends Controller
{
    public function index()
    {
        return view('admin.users.index', [
            'users' => User::all(),
        ]);
    }

    public function show(User $user)
    {
        return view('admin.users.show', [
            'user' => $user,
        ]);
    }
}