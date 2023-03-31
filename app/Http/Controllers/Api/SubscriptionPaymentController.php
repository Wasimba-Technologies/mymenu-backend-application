<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSubscriptionPaymentRequest;
use App\Http\Requests\UpdateSubscriptionPaymentRequest;
use App\Models\SubscriptionPayment;

class SubscriptionPaymentController extends Controller
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
    public function store(StoreSubscriptionPaymentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SubscriptionPayment $subscriptionPayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubscriptionPaymentRequest $request, SubscriptionPayment $subscriptionPayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubscriptionPayment $subscriptionPayment)
    {
        //
    }
}
