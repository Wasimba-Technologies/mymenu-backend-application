<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @method static create(mixed $validated)
 */
class Ingredient extends Model
{
    use HasFactory, BelongsToTenant;

        protected $guarded = ['id'];

    public function menuItems(): BelongsToMany
    {
        return $this->belongsToMany(MenuItem::class, 'ingredient_menu_item');
    }
}
