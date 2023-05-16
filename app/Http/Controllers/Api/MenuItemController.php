<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuItemRequest;
use App\Http\Resources\MenuItemCollection;
use App\Http\Resources\MenuItemResource;
use App\Models\MenuItem;
use App\Models\Order;
use App\Models\Restaurant;
use App\Models\Scopes\TenantScope;
use App\Traits\HasImage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class MenuItemController extends Controller
{
    use HasImage;

    /**
     * Display a listing of the resource.
     */
    public function index(): MenuItemCollection
    {
        return new MenuItemCollection(MenuItem::when(
            request('name'), function($query){
            $query->where('name', 'like', '%'.request('name').'%');
            }
        )->paginate(20));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MenuItemRequest $request): MenuItemResource | JsonResponse
    {
        $orders = Order::all();
        $tenant_id = $request->header('X-TENANT-ID');
        $tenant = Restaurant::withoutGlobalScope(TenantScope::class)->with('plan')->findOrFail($tenant_id);
        if(count($orders) < $tenant->plan->menu_items){
            $data = $this->getDataAndSaveImage('images', $request);
            //$data['tenant_id'] = $request->header('X-TENANT-ID');
            $menu_item = MenuItem::create($data);
            return new MenuItemResource($menu_item);
        }
        return response()->json([
            'status'=> 'failure',
            'message'=> "Maximum menu items in your plan reached"
        ]);
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
        $data = $this->getDataAndSaveImage('images', $request);
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
