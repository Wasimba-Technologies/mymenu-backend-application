<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlanRequest;
use App\Http\Resources\PlanCollection;
use App\Http\Resources\PlanResource;
use App\Models\Plan;
use App\Models\Scopes\TenantScope;
use Illuminate\Http\Response;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): PlanCollection
    {
        $this->authorize('viewAny', Plan::class);
        $plans = Plan::withoutGlobalScope(TenantScope::class)->paginate(20);
        return new PlanCollection($plans);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PlanRequest $request): PlanResource
    {
        $this->authorize('create', Plan::class);
        $data = $request->validated();
        $plan = Plan::create($data);
        return new PlanResource($plan);
    }

    /**
     * Display the specified resource.
     */
    public function show(Plan $plan): PlanResource
    {
        $this->authorize('view', $plan);
        return new PlanResource($plan);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PlanRequest $request, Plan $plan): PlanResource
    {
        $this->authorize('update', $plan);
        $data = $request->validated();
        Plan::update($data);
        return new PlanResource($plan);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plan $plan): Response
    {
        $this->authorize('delete', $plan);
        $plan->delete();
        return response()->noContent();
    }
}
