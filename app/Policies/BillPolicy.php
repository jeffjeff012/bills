<?php

namespace App\Policies;

use App\Models\Bill;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use App\Enums\UserRole;

class BillPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Bill $bill): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
     public function update(User $user, Bill $bill): bool
    {
        // Staff cannot edit bills created by Admin
        if ($user->role === UserRole::SbStaff && $bill->user?->role === UserRole::Admin) {
            return false;
        }

        return true;
    }

    /**
     * Determine if the given bill can be deleted by the user.
     */
    public function delete(User $user, Bill $bill): bool
    {
        // Staff cannot delete bills created by Admin
        if ($user->role === UserRole::SbStaff && $bill->user?->role === UserRole::Admin) {
            return false;
        }

        return true;
    }
    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Bill $bill): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Bill $bill): bool
    {
        return false;
    }
}
