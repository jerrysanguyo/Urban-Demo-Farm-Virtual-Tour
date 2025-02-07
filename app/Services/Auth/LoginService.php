<?php

namespace App\Services\Auth;
use Illuminate\Support\Facades\Auth;

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