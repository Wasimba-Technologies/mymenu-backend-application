<?php

namespace App\Traits;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToTenant
{
    protected static function bootBelongsToTenant(): void
    {

        //static::addGlobalScope(new TenantScope);

        static::creating(function ($model) {
            if(auth('auth:sanctum')->check()){
                if(auth('auth:sanctum')->user()->tenant_id != null){
                    $model->tenant_id = auth('auth:sanctum')->user()->tenant_id;
                }
            }

        });

        static::updating(function ($model) {
            if(auth('auth:sanctum')->check()){
                if(auth('auth:sanctum')->user()->tenant_id != null){
                    $model->tenant_id = auth('auth:sanctum')->user()->tenant_id;
                }
            }
        });
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }
}
