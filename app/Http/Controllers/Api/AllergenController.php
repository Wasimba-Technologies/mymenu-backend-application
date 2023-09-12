<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAllergenRequest;
use App\Http\Requests\UpdateAllergenRequest;
use App\Http\Resources\AllergenResource;
use App\Models\Allergen;

class AllergenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return AllergenResource::collection(Allergen::when(
            request('name'),
            fn ($query) => $query->where('name', 'LIKE', '%' . request('name') . '%')
        )->all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAllergenRequest $request)
    {
        $allergen = Allergen::create($request->validated());
        return new AllergenResource($allergen);
    }

    /**
     * Display the specified resource.
     */
    public function show(Allergen $allergen)
    {
        return new AllergenResource($allergen);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAllergenRequest $request, Allergen $allergen)
    {
        $allergen->update($request->validated());
        return new AllergenResource($allergen);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Allergen $allergen)
    {
        $allergen->delete();
        return response()->noContent();
    }
}
