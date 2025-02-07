<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Services\Auth\LoginService;

class loginController extends Controller
{
    protected $loginService;

    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    public function index()
    {
        return view("auth.login");
    }

    public function login(LoginService $request)
    {
        $data = $request->validated();
        $this->loginService->login($data);

        return redirect()->route(Auth::user()->role . '.dashboard')
            ->with('success', 'You are logged in');
    }
}
