<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends Model
{
    use HasFactory, BelongsToTenant;

    protected $guarded= [];

    public function menu_items(): HasMany
    {
        return $this->hasMany(MenuItem::class);
    }

}
