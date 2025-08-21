<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Enums\UserRole;

class AuthServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Gate::define('access-reports', function ($user) {
            return in_array($user->role, [
                UserRole::Admin,
                UserRole::SbStaff
            ]);
        });
    }
}