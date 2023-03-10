<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static paginate(int $int)
 * @method static create(mixed $data)
 */
class Table extends Model
{
    use HasFactory, BelongsToTenant;

    protected $guarded = [];

    public function orders(){
        return $this->hasMany(Order::class);
    }
}
