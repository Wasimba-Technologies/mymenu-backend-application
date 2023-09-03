<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class OrderMenuItem extends Model
{
    use HasFactory, BelongsToTenant;

    protected $guarded = [];

//
//    public function order(): BelongsTo
//    {
//        return $this->belongsTo(Order::class);
//    }
//
//    public function menu_item(): BelongsTo
//    {
//        return $this->belongsTo(MenuItem::class);
//    }


}
