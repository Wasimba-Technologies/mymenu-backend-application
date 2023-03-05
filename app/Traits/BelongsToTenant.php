<?php

namespace App\Traits;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Query\Builder;

trait BelongsToTenant
{

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function scopeOfTenantId(Builder $query, string $tenant_id): void
    {
        $query->where('tenant_id', $tenant_id);
    }
}
