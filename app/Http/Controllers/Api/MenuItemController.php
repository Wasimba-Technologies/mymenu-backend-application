<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuItemRequest;
use App\Http\Resources\MenuItemResource;
use App\Models\MenuItem;
use App\Models\Restaurant;
use App\Traits\HasImage;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class MenuItemController extends Controller
{
    use HasImage;

    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        return MenuItemResource::collection(Restaurant::when(request('name'), function($query){
            $query->where('name', 'like', '%'.request('name').'%');
        })->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MenuItemRequest $request): MenuItemResource
    {
        //$data = $request->validated();
        $data = $this->getDataAndSaveImage('logos', $request);
        $data['tenant_id'] = $request->header('X-TENANT-ID');
        $menu_item = MenuItem::create($data);
        return new MenuItemResource($menu_item);
    }

    /**
     * Display the specified resource.
     */
    public function show(MenuItem $menu_item): MenuItemResource
    {
        return new MenuItemResource($menu_item);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MenuItemRequest $request, MenuItem $menu_item)
    {
        //$data = $request->validated();
        $data = $this->getDataAndSaveImage('logos', $request);
        $menu_item->update($data);
        return new  MenuItemResource($menu_item);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MenuItem $menu_item): Response
    {
        $menu_item->delete();
        return response()->noContent();
    }
}
