<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use App\Http\Resources\MenuCollection;
use App\Http\Resources\MenuResource;
use App\Models\Menu;
use App\Traits\HasImage;
use Illuminate\Http\Response;

class MenuController extends Controller
{
    use HasImage;

    /**
     * Display a listing of the resource.
     */
    public function index(): MenuCollection
    {
        return new MenuCollection(Menu::when(request('name'), function($query){
            $query->where('name', 'like', '%'.request('name').'%');
        })->paginate(20));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMenuRequest $request): MenuResource
    {
        $data = $this->getDataAndSaveImage('images', $request);
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
    public function update(UpdateMenuRequest $request, Menu $menu)
    {
        $data = $this->getDataAndSaveImage('images', $request);
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
