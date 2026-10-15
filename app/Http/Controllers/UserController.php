<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index(): View
    {
        return view('users.index', [
            'users' => User::query()->orderBy('name')->get(),
        ]);
    }

    /**
     * Show the form for editing the given user.
     */
    public function edit(User $user): View
    {
        return view('users.edit', [
            'user' => $user,
        ]);
    }
}
