<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuItemRequest;
use App\Http\Requests\MenuRequest;
use App\Http\Resources\MenuItemResource;
use App\Http\Resources\MenuResource;
use App\Models\Menu;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class MenuController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        return MenuResource::collection(Menu::when(request('name'), function($query){
            $query->where('name', 'like', '%'.request('name').'%');
        })->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MenuRequest $request): MenuResource
    {
        $data = $request->validated();
        $data['tenant_id'] = $request->header('X-TENANT-ID');
        $menu = Menu::create($data);
        return new MenuResource($menu);
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu): MenuResource
    {
        return new MenuResource($menu);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MenuRequest $request, Menu $menu)
    {
        $data = $request->validated();
        $menu->update($data);
        return new  MenuResource($menu);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu): Response
    {
        $menu->delete();
        return response()->noContent();
    }
}
