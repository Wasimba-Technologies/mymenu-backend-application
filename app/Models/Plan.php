<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static paginate(int $int)
 * @method static withoutGlobalScope(string $class)
 */
class Plan extends Model
{
    use HasFactory, BelongsToTenant;
    protected $guarded = [];
}
