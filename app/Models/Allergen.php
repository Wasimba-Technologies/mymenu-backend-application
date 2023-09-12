<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(mixed $validated)
 */
class Allergen extends Model
{
    use HasFactory, BelongsToTenant;

        protected $guarded = ['id'];
}
