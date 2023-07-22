<?php

namespace App\Models;

use App\Models\Scopes\TenantScope;
use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Subscription extends Model
{
    use HasFactory, BelongsToTenant;

    protected $guarded = [];

    public function payment(): HasOne
    {
        return $this->hasOne(SubscriptionPayment::class);
    }

    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class)
                    ->withoutGlobalScope(TenantScope::class);
    }
}
