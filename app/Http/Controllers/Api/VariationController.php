<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVariationRequest;
use App\Http\Requests\UpdateVariationRequest;
use App\Http\Resources\VariationResource;
use App\Models\Variation;

class VariationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return VariationResource::collection(Variation::when(
            request()->has('name'),
            fn ($query) => $query->where('name', 'like', '%' . request('name') . '%')
        )->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVariationRequest $request)
    {
        $variation = Variation::create($request->validated());
        return new VariationResource($variation);
    }

    /**
     * Display the specified resource.
     */
    public function show(Variation $variation)
    {
        return new VariationResource($variation);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVariationRequest $request, Variation $variation)
    {
        $variation->update($request->validated());
        return new VariationResource($variation);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Variation $variation)
    {
        $variation->delete();
        return response()->noContent();
    }
}
