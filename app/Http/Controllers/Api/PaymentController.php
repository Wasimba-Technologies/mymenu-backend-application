<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use App\Http\Resources\PaymentCollection;
use App\Http\Resources\PaymentResource;
use App\Models\Payment;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Payment::class);
        return new PaymentCollection(Payment::paginate(20));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PaymentRequest $request)
    {
        $this->authorize('create', Payment::class);
        $data = request()->json()->all();
        $payment = Payment::create(
            [
                'amount'=> $data['amount'],
                'order_id' => $data['order_id'],
                'received_by' => request()->user()->id,
            ]
        );
        return response()->json([
            'status' => 'success',
            'message' => 'Payment recorded successfully',
            'payment' => $payment
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        $this->authorize('view', $payment);
        return new PaymentResource($payment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PaymentRequest $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        $this->authorize('delete', $payment);
        $payment->delete();
        return response()->noContent();
    }
}
