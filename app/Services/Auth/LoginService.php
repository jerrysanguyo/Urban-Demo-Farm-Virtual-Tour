<?php

namespace App\Services\Auth;
use App\Models\User;

class LoginService
{
    public function login(array $data):bool
    {
        return Auth::attempt([
            'email' => $data['email'],
            'password'=> $data['password'],
        ]);
    }
}