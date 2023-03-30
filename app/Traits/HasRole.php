<?php

namespace App\Traits;

use App\Models\Role;
use App\Models\Scopes\TenantScope;

trait HasRole
{

    public function role() {
        return $this->belongsTo(Role::class)->withoutGlobalScope(TenantScope::class);
    }

    /**
     * Verifies user has specified role.
     *
     * @return boolean
     */
    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->role->name === $role;
        }

        return $role->contains('name', $this->role->name);
    }
}
