<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAddonRequest;
use App\Http\Requests\UpdateAddonRequest;
use App\Http\Resources\AddonResource;
use App\Models\Addon;

class AddonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return AddonResource::collection(Addon::when(
            request()->has('name'),
            fn ($query) => $query->where('name', request()->name)
        )->all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAddonRequest $request)
    {
        //store addon
        $addon = Addon::create($request->validated());
        return new AddonResource($addon);
    }

    /**
     * Display the specified resource.
     */
    public function show(Addon $addon)
    {
        return new AddonResource($addon);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAddonRequest $request, Addon $addon)
    {
        $addon->update($request->validated());
        return new AddonResource($addon);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Addon $addon)
    {
        $addon->delete();
        return response()->noContent();
    }
}
