<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class VariationValue extends Model
{
    use HasFactory, BelongsToTenant;

        protected $guarded = ['id'];

    public function variation(): BelongsTo
    {
        return $this->belongsTo(Variation::class);
    }

    public function menuItems(): BelongsToMany
    {
        return $this->belongsToMany(MenuItem::class, 'menu_item_variation_value');
    }
}
