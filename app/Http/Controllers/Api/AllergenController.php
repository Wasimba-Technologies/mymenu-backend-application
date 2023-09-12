<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAllergenRequest;
use App\Http\Requests\UpdateAllergenRequest;
use App\Models\Allergen;

class AllergenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAllergenRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Allergen $allergen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAllergenRequest $request, Allergen $allergen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Allergen $allergen)
    {
        //
    }
}
