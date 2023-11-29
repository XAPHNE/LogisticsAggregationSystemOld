<?php

namespace App\Http\Middleware;

use Closure;

class CheckUserRole
{
    public function handle($request, Closure $next, $role)
    {
        // Get the authenticated user
        $user = auth()->user();

        // Check if the user's role matches the expected role
        if ($user && $user->role_id === 1) {
            return $next($request);
        }

        if ($user && $user->role_id != $role) {
            return redirect()->route('404');
        }

        return $next($request);
    }
}