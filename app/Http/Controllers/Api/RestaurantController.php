<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RestaurantRequest;
use App\Http\Resources\RestaurantCollection;
use App\Http\Resources\RestaurantResource;
use App\Models\Restaurant;
use App\Traits\HasImage;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class RestaurantController extends Controller
{
    use HasImage;

    /**
     * Display a listing of the resource.
     * @throws AuthorizationException
     */
    public function index(): RestaurantCollection
    {
        $this->authorize('viewAny', Restaurant::class);
        return new RestaurantCollection(Restaurant::when(request('name'), function($query){
            $query->where('name', 'like', '%'.request('name').'%');
        })->paginate(20));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RestaurantRequest $request): RestaurantResource
    {
        //$data = $request->validated();
        $this->authorize('create', Restaurant::class);
        $data = $this->getDataAndSaveImage('logos', $request);
        $restaurant = Restaurant::create($data);
        $user = $request->user()->tenant()->associate($restaurant);
        $user->save();
        return new RestaurantResource($restaurant);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): RestaurantResource
    {
        $this->authorize('show', Restaurant::class);
        $restaurant = Restaurant::where('id', $id)->first();
        return new RestaurantResource($restaurant);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RestaurantRequest $request, $id)
    {
        $this->authorize('update', Restaurant::class);
        $restaurant = Restaurant::where('id', $id)->first();
        $data = $this->getDataAndSaveImage('logos', $request);
        $restaurant->update($data);
        return new RestaurantResource($restaurant);
    }

    /**
     * Remove the specified resource from storage.
     * @throws AuthorizationException
     */
    public function destroy(Restaurant $restaurant): Response
    {
        $this->authorize('delete', $restaurant);
        $restaurant->delete();
        return response()->noContent();
    }
}
