<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Enums\UserRole;

class BillsAccess
{
    public function handle(Request $request, Closure $next)
    {
        $userRole = $request->user()->role;

        if ($userRole === UserRole::User) {
            // Redirect regular users to their dashboard
            return redirect()->route('dashboard'); 
        }

        // Admin and SbStaff can proceed
        return $next($request);
    }
}
