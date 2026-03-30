<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        $isAdmin = $user
            && $user->role
            && strcasecmp((string) $user->role->name, 'Admin') === 0;

        if (! $isAdmin) {
            return redirect()
                ->route('dashboard')
                ->with('error', 'You are not authorized to access user management.');
        }

        return $next($request);
    }
}

