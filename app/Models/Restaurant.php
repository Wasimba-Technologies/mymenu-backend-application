<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Storage;

/**
 * @method static create($data)
 */
class Restaurant extends Model
{
    use HasFactory, HasUlids;

    protected $guarded= [];

   // protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;


    public function plan(): HasOne
    {
        return $this->hasOne(Plan::class);
    }

//    protected function logo(): Attribute
//    {
//        //Transform logo to be a URL
//        return Attribute::make(
//            get: fn (string $value) => env('APP_URL'). Storage::url($value),
//        );
//    }

}
