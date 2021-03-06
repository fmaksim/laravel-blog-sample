<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class AuthService
{

    public function login($request): bool
    {
        $data = [
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        ];

        if (Auth::attempt($data)) {
            return true;
        }

        return false;
    }

    public function logout(): void
    {
        Auth::logout();
    }
}
