<?php

namespace App\Traits;

use App\Models\Permission;
use App\Models\Scopes\TenantScope;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasPermission
{
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'permissions')->withoutGlobalScope(TenantScope::class);
    }

    public function hasPermission($perm): bool
    {
        return $this->permissions->contains('name', $perm) || $this->role->permissions->contains('name', $perm);
    }

}
