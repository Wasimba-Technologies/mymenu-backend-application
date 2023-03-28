<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @method static create(array $array)
 * @method static withoutGlobalScope(string $class)
 */
class Role extends Model
{
    use HasFactory, BelongsToTenant;

    const ADMIN = 1;
    const CHEF = 2;
    const WAITER = 3;
    const CASHIER = 4;

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
