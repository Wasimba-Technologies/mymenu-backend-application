<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use App\Traits\HasImage;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;

class MenuItem extends Model
{
    use HasFactory, BelongsToTenant, HasImage;

    protected $guarded= [];

    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, 'order_menu_item');
    }


}
