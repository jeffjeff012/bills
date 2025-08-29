<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CreateBillMiddleware
{
    public function handle($request, Closure $next, ...$roles)
    {
        if (!Auth::check() || ! in_array(Auth::user()->role, $roles)) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}

