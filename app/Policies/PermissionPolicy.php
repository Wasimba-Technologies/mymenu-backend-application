<?php

namespace App\Policies;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PermissionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('permissions.viewAny');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Permission $permission): bool
    {
        return $user->hasPermission('permissions.view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermission('permissions.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Permission $permission): bool
    {
        return $user->hasPermission('permissions.update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Permission $permission): bool
    {
        return $user->hasPermission('permissions.delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Permission $permission): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Permission $permission): bool
    {
        //
    }
}
