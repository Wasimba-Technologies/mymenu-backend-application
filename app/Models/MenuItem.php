<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use App\Traits\HasImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory, BelongsToTenant, HasImage;

    protected $guarded= [];

}
