<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMenuItemRequest;
use App\Http\Resources\MenuItemCollection;
use App\Http\Resources\MenuItemResource;
use App\Models\MenuItem;
use App\Models\Restaurant;
use App\Models\Scopes\TenantScope;
use App\Traits\HasImage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use stubs\UpdateMenuItemRequest;

/**
 * @method static count()
 */
class MenuItemController extends Controller
{
    use HasImage;

    /**
     * Display a listing of the resource.
     */
    public function index(): MenuItemCollection
    {
        //$this->authorize('viewAny', MenuItem::class); all users should see this
        return new MenuItemCollection(MenuItem::when(
            request('name'), function($query){
            $query->where('name', 'like', '%'.request('name').'%');
            }
        )->paginate(20));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMenuItemRequest $request): MenuItemResource | JsonResponse
    {
        $this->authorize('create', MenuItem::class);
        $items = MenuItem::count();
        $tenant_id = $request->header('X-TENANT-ID');
        $tenant = Restaurant::withoutGlobalScope(TenantScope::class)->with('plan')->findOrFail($tenant_id);
        if($items < $tenant->plan->menu_items){
            $data = $this->getDataAndSaveImage('images', $request);
            //$data['tenant_id'] = $request->header('X-TENANT-ID');
            $menu_item = MenuItem::create($data);
            $menu_item->ingredients()->attach($request->ingredients);
            $menu_item->addons()->attach($request->addons);
            $menu_item->variation_values()->attach($request->variation_values);
            $menu_item->allergens()->attach($request->allergens);
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
        $this->authorize('view', $menu_item);
        return new MenuItemResource($menu_item->load('ingredients','addons', 'variation_values', 'allergens'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMenuItemRequest $request, MenuItem $menu_item)
    {
        $this->authorize('update', $menu_item);
        $data = $this->getDataAndSaveImage('images', $request);
        $menu_item->update($data);
        return new  MenuItemResource($menu_item);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MenuItem $menu_item): Response
    {
        $this->authorize('delete', $menu_item);
        $menu_item->delete();
        return response()->noContent();
    }
}
