<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RestaurantRequest;
use App\Http\Resources\RestaurantResource;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        return RestaurantResource::collection(Restaurant::when(request('name'), function($query){
            $query->where('name', 'like', '%'.request('name').'%');
        })->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RestaurantRequest $request): RestaurantResource
    {
        $data = $request->validated();
        $restaurant = Restaurant::create($data);
        $user = $request->user()->tenant()->associate($restaurant);
        $user->save();
        return new RestaurantResource($restaurant);
    }

    /**
     * Display the specified resource.
     */
    public function show(Restaurant $restaurant): RestaurantResource
    {
        return new RestaurantResource($restaurant);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RestaurantRequest $request, Restaurant $restaurant)
    {
        $data = $request->validated();
        $restaurant->update($data);
        return new RestaurantResource($restaurant);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Restaurant $restaurant): Response
    {
        $restaurant->delete();
        return response()->noContent();
    }
}
