<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class checkUserRole
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user) {
            return redirect()->route('login.index'); 
        }

        $rolePrefixMapping = config('role'); 
        $prefix = ltrim($request->route()->getPrefix(), '/');

        if (!isset($rolePrefixMapping[$user->role]) || $rolePrefixMapping[$user->role] !== $prefix) {
            abort(403, 'Unauthorized'); 
        }

        return $next($request);
    }
}
