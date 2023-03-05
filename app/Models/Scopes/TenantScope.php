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
//        if(auth()->check()){
//            if(auth()->user()->tenant_id != null){
//                $builder->where('tenant_id', Request::user()->tenant_id)->get();
//            }
//        }
    }
}
