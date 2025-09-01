<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OnlyAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        if ($user->role === \App\Enums\UserRole::Admin) {
            return $next($request); // ✅ allow admins only
        }

        if($user->role === \App\Enums\UserRole::SbStaff) {
            return $next($request); 
        }



        // Default (for Users or anything else)
            abort(403, 'You may not proceed.');
    }


}
