<?php

namespace App\Models;

use App\Models\Scopes\TenantScope;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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


    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class)->withoutGlobalScope(TenantScope::class);
    }

}
