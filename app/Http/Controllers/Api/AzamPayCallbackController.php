<?php

namespace App\Http\Controllers\Api;

use App\Events\OrderPaid;
use App\Events\SubscriptionPaid;
use App\Http\Controllers\Controller;
use App\Http\Requests\AzamPayCallbackRequest;
use App\Models\Order;
use App\Models\Subscription;
use App\Models\SubscriptionPayment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class AzamPayCallbackController extends Controller
{
    public function store(AzamPayCallbackRequest $request) {
        $data = (object)$request->validated();
        if ($data->transactionstatus == 'success'){
            if ($data->additionalProperties['property1'] == 'subscription'){
                $subscription = Subscription::findOrFail($data->utilityref);
                $subscription->status = 'active';
                $subscription->start_date = Carbon::today()->toDateString();
                $subscription->end_date = Carbon::today()->addDays(30)->toDateString();
                $subscription->save();
                SubscriptionPayment::create([
                  'subscription_id' =>  $subscription->id,
                  'amount' => $data->amount,
                  'payment_method' => $data->provider,
                  'payment_channel' => 'AzamPay',
                  'account_no' => $data->msisdn,
                  'reference_no' => $data->reference,
                  'tenant_id' => $subscription->tenant_id,
                ]);
                SubscriptionPaid::dispatch($subscription);
            }else{
                $order = Order::findOrFail($data->utilityref);
                $order->status = 'Paid';
                $order->grand_total = $data->amount;
                $order->save();
                OrderPaid::dispatch($order);
            }
        }

        //If payment Failed return un-updated Model

        if($data->additionalProperties['property1'] == 'subscription'){
            $subscription = Subscription::findOrFail($data->utilityref);
            SubscriptionPaid::dispatch($subscription);
        }else{
            $order = Order::findOrFail($data->utilityref);
            OrderPaid::dispatch($order);
        }

    }
}
