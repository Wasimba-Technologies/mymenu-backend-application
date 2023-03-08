<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MenuItemResource;
use App\Models\MenuItem;
use App\Models\Table;
use Illuminate\Http\JsonResponse;

class MenuBrowser extends Controller
{
    public function browse($id): JsonResponse
    {
        $table = Table::findOrFail($id)->first();

        $tenant_id = $table->tenant_id;

        $menu_items = MenuItem::when(request('name'), function($query){
            $query->where('menu_id', 'like', '%'.request('name').'%');
        })->where('tenant_id', $tenant_id)->get();

        return response()->json([
            'status' => 'success',
            'menu_items' => MenuItemResource::collection($menu_items),
            'tenant_id' => $tenant_id
        ], 200);
    }
}
