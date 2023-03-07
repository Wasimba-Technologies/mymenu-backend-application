<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @method static create($data)
 */
class Restaurant extends Model
{
    use HasFactory, HasUlids;

    protected $guarded= [];

    public function plan(): HasOne
    {
        return $this->hasOne(Plan::class);
    }

}
