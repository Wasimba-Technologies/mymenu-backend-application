<?php

namespace App\Traits;
use App\Models\Restaurant;
use App\Models\Scopes\TenantScope;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Query\Builder;

trait BelongsToTenant
{

    protected static function bootBelongsToTenant(): void
    {

        static::addGlobalScope(new TenantScope);

        static::creating(function ($model) {

            $tenant_id = request()->header('X-TENANT-ID');
            if( $tenant_id != null){
                $model->tenant_id = $tenant_id;
            }
        });

    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }

}
