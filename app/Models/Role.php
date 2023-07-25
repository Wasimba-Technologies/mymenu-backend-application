<?php

namespace App\Models;

use App\Models\Scopes\TenantScope;
use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static create(array $array)
 * @method static withoutGlobalScope(string $class)
 */
class Role extends Model
{
    use HasFactory, BelongsToTenant;

    const SUPER_ADMIN = 1;
    const ADMIN = 2;
    const CHEF = 3;
    const WAITER = 4;
    const CASHIER = 5;

    const CUSTOMER = 6;

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(
            Permission::class,
            'role_permission',
            'role_id',
            'permission_id'
        )->withoutGlobalScope(TenantScope::class);
    }


}
