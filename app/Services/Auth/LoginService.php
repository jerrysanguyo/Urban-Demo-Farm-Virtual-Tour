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

    public function logout(): bool
    {
        Auth::logout(); 
        request()->session()->invalidate(); 
        request()->session()->regenerateToken();
    
        return true;
    }
}