<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory, BelongsToTenant;

    protected $guarded = [];

    public function menu_items(): belongsToMany
    {
        return $this->belongsToMany(MenuItem::class, 'order_menu_item')->withPivot('qty');;
    }

    public function table(): BelongsTo
    {
        return $this->belongsTo(Table::class);
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }
}
