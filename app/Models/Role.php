<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @method static create(array $array)
 */
class Role extends Model
{
    use HasFactory, BelongsToTenant;

    const ADMIN = 'Admin';
    const CHEF = 'Chef';
    const WAITER = 'Waiter';
    const CASHIER = 'Cashier';
}
