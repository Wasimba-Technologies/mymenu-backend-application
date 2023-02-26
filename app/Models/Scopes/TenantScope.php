<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Request;

class TenantScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $builder->where('tenant_id', 1)->get();
        if(auth('auth:sanctum')->check()){
            if(auth('auth:sanctum')->user()->tenant_id != null){
                $builder->where('tenant_id', Request::user()->tenant_id)->get();
            }
        }
    }
}
