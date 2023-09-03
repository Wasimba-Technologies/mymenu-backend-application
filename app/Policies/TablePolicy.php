<?php

namespace App\Policies;

use App\Models\Restaurant;
use App\Models\Table;
use App\Models\User;

class TablePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('tables.viewAny');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Table $table): bool
    {
        return $user->hasPermission('tables.view');
    }

    /**
     * Determine whether the user can create the model
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->hasPermission('tables.create');
    }

    public function update(User $user, Table $table): bool
    {
        return $user->hasPermission('tables.update');
    }

    public function delete(User $user, Table $table): bool
    {
        return $user->hasPermission('tables.delete');
    }
}
