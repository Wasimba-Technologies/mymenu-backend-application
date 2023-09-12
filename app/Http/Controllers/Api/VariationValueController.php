<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVariationValueRequest;
use App\Http\Requests\UpdateVariationValueRequest;
use App\Http\Resources\VariationValueResource;
use App\Models\VariationValue;

class VariationValueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return VariationValueResource::collection(
            VariationValue::with('variation')
            //query by variationValue.name
            ->when(function ($query) {
                return request()->has('name') ? $query->where('name', 'like', '%' . request('variation') . '%') : $query;
            })
            //query by variation.name
            ->when(function ($query) {
                return request()->has('variation') ? $query->whereHas('variation', function ($query) {
                    $query->where('name', 'like', '%' . request('variation') . '%');
                }) : $query;
            })->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVariationValueRequest $request)
    {
        $value = VariationValue::create($request->validated());
        return new VariationValueResource($value);
    }

    /**
     * Display the specified resource.
     */
    public function show(VariationValue $variationValue)
    {
        return new VariationValueResource($variationValue);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVariationValueRequest $request, VariationValue $variationValue)
    {
        $variationValue->update($request->validated());
        return new VariationValueResource($variationValue);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VariationValue $variationValue)
    {
        $variationValue->delete();
        return response()->noContent();
    }
}
