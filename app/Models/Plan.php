<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static paginate(int $int)
 * @method static withoutGlobalScope(string $class)
 */
class Plan extends Model
{
    use HasFactory, BelongsToTenant;
    protected $guarded = [];

    public function restaurants(): HasMany
    {
        return $this->hasMany(Restaurant::class);
    }

    public function subscription(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }
}
