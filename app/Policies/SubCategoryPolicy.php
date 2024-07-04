<?php

namespace App\Policies;

use App\Models\SubCategory;
use App\Models\User;

class SubCategoryPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        if (($user->is_admin && $user->permissions->contains('permission_type', 'view')) || ($user->is_admin && str_ends_with($user->email, '@superadmin.com'))) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, SubCategory $subCategory): bool
    {
        if (($user->is_admin && $user->permissions->contains('permission_type', 'view')) || ($user->is_admin && str_ends_with($user->email, '@superadmin.com'))) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        if (($user->is_admin && $user->permissions->contains('permission_type', 'create')) || ($user->is_admin && str_ends_with($user->email, '@superadmin.com'))) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, SubCategory $subCategory): bool
    {
        if (($user->is_admin && $user->permissions->contains('permission_type', 'edit')) || ($user->is_admin && str_ends_with($user->email, '@superadmin.com'))) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, SubCategory $subCategory): bool
    {
        if (($user->is_admin && $user->permissions->contains('permission_type', 'delete')) || ($user->is_admin && str_ends_with($user->email, '@superadmin.com'))) {
            return true;
        }

        return false;
    }
}
