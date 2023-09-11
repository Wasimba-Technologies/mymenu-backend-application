<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAddonRequest;
use App\Http\Requests\UpdateAddonRequest;
use App\Models\Addon;

class AddonController extends Controller
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
    public function store(StoreAddonRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Addon $addon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAddonRequest $request, Addon $addon)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Addon $addon)
    {
        //
    }
}
