<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RestaurantRequest;
use App\Http\Resources\RestaurantCollection;
use App\Http\Resources\RestaurantResource;
use App\Models\Restaurant;
use App\Traits\HasImage;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class RestaurantController extends Controller
{
    use HasImage;

    /**
     * Display a listing of the resource.
     */
    public function index(): RestaurantCollection
    {
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
        $data = $this->getDataAndSaveImage('logos', $request);
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
        //$data = $request->validated();
        $data = $this->getDataAndSaveImage('logos', $request);
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
