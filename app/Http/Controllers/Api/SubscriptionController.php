<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSubscriptionRequest;
use App\Http\Requests\UpdateSubscriptionRequest;
use App\Http\Resources\SubscriptionResource;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        return SubscriptionResource::collection(
            Subscription::with(['plan','payments'])->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubscriptionRequest $request)
    {
        $subscription = [];
        $data = json_decode((string)$request->json()->all());
        $subscription['plan_id'] = $data->plan->id;
        $subscription['start_date'] = Carbon::today();
        if ($data->plan->price == 0){
            $subscription['end_date'] = null;
        }else{
            $subscription['end_date'] = Carbon::today()->addDays(7);
        }
        $subscription['tenant_id'] = request()->header('X-TENANT-ID');

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
        //
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
