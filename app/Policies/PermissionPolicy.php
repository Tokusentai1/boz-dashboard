<?php

namespace App\Policies;

use App\Models\User;
use App\Models\permission;

class PermissionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        if (($user->is_admin && str_ends_with($user->email, '@superadmin.com'))) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, permission $permission): bool
    {
        if (($user->is_admin && str_ends_with($user->email, '@superadmin.com'))) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        if (($user->is_admin && str_ends_with($user->email, '@superadmin.com'))) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, permission $permission): bool
    {
        if (($user->is_admin && str_ends_with($user->email, '@superadmin.com'))) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, permission $permission): bool
    {
        if (($user->is_admin && str_ends_with($user->email, '@superadmin.com'))) {
            return true;
        }

        return false;
    }
}
