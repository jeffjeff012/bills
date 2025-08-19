<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Enums\UserRole;

class SbStaffMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is Staff
        if (auth()->user()->role !== UserRole::SbStaff) {
            abort(403); // or redirect to another page
        }

        return $next($request);
    }
}
