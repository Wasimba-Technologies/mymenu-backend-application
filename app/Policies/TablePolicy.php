<?php

namespace App\Policies;

use App\Models\User;

class TablePolicy
{
    public function create(User $user): bool
    {
        return $user->hasPermission('tables.create');
    }

    public function update(User $user): bool
    {
        return $user->hasPermission('tables.update');
    }

    public function delete(User $user): bool
    {
        return $user->hasPermission('tables.delete');
    }
}
