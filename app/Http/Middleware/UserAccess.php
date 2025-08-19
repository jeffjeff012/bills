<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Enums\UserRole;

class UserAccess
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        if ($user->role !== UserRole::User) {
            // Redirect SbStaff and Admin away
            if ($user->role === UserRole::SbStaff) {
                return redirect()->route('staff.dashboard');
            } else { // Admin
                return redirect()->route('admin.dashboard');
            }
        }

        return $next($request);
    }
}
