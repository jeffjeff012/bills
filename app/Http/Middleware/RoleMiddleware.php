<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Enums\UserRole;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if (! $user) {
            return redirect()->route('login');
        }

        // Allow Admin and SbStaff
        if (in_array($user->role, [UserRole::Admin->value, UserRole::SbStaff->value], true)) {
            return $next($request);
        }

        // Block normal Users
        abort(403, 'Unauthorized');

    }

    
}
