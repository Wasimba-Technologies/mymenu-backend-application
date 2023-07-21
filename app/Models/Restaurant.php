<?php

namespace App\Models;

use App\Models\Scopes\TenantScope;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


/**
 * @method static create($data)
 */
class Restaurant extends Model
{
    use HasFactory, HasUlids;

    protected $guarded = ['id'];

   protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;


    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class)->withoutGlobalScope(TenantScope::class);
    }

    public function subscription(): BelongsTo
    {
        return $this->belongsTo(Subscription::class);
    }

}
