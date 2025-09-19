<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Enums\UserRole;

class AdminMiddleware
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

        switch ($user->role) {
            case \App\Enums\UserRole::Admin:
                return $next($request); 
            case \App\Enums\UserRole::SbStaff:
                abort(403); 
            case \App\Enums\UserRole::User:
            default:
                return redirect()->route('dashboard');
        }
    }

}
