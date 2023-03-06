<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use App\Traits\HasImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MenuItem extends Model
{
    use HasFactory, BelongsToTenant, HasImage;

    protected $guarded= [];

    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }

}
