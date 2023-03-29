<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasPermission
{
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function hasPermission($perm){
        return $this->permissions->contains('name', $perm) ||
                $this->role->permissions->contains('name', $perm);
    }

    public function user_permissions(): array
    {
        return [];
    }
}
