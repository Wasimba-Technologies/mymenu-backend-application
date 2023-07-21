<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSubscriptionRequest;
use App\Http\Requests\UpdateSubscriptionRequest;
use App\Http\Resources\SubscriptionCollection;
use App\Http\Resources\SubscriptionResource;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Log;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): SubscriptionCollection
    {
        $this->authorize('viewAny', Subscription::class);
        return new SubscriptionCollection(
            Subscription::with(['plan'])->paginate(10)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubscriptionRequest $request): JsonResponse
    {
        $this->authorize('create', Subscription::class);
        $subscription = [];
        $data = (object)$request->json()->all();
        $subscription['plan_id'] = $data->plan['id']; //plan is an array
        $subscription['start_date'] = Carbon::today();
        if ($data->plan['price'] == 0){
            $subscription['end_date'] = Carbon::today()->addYears();
        }else{
            $subscription['end_date'] = Carbon::today()->addDays(7);
        }
        $subscription['tenant_id'] = request()->header('X-TENANT-ID');

        Log::info(json_encode($subscription));

        $sub = Subscription::create($subscription);


        return response()->json(
            [
                'status' => 'success',
                'message' => 'Information stored Successfully',
                'subscription' => $sub
            ]
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Subscription $subscription)
    {
        return new SubscriptionResource($subscription->load(['payments','plan','tenant']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubscriptionRequest $request, Subscription $subscription)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subscription $subscription)
    {
        //
    }
}
