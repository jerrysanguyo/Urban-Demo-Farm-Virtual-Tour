<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;
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

    public function login(LoginRequest $request)
    {
        $this->loginService->login($request->validated());

        return redirect()
            ->route(Auth::user()->role . '.dashboard')
            ->with('success', 'You are logged in');
    }

    public function logout()
    {
        $this->loginService->logout();

        return redirect()
            ->route('login.index')
            ->with('success', 'You have logout successfullly!');
    }
}
