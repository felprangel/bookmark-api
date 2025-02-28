<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UsersController
{
    public function createUser()
    {
        $data = Request::validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email', Rule::unique('users')],
            'password' => ['required', 'confirmed', Password::min(8)]
        ]);

        $user = User::create($data);
        Auth::login($user);
    }

    public function login()
    {
        return 'hello world';
    }
}
