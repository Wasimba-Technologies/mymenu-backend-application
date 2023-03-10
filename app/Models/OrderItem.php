<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class OrderItem extends Model
{
    use HasFactory, BelongsToTenant;

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function menu_item(): BelongsTo
    {
        return $this->belongsTo(MenuItem::class);
    }

    protected $guarded = [];

}
