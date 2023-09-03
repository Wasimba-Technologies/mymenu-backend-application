<?php

namespace App\Actions;

use App\Mail\SubscriptionExpired;
use App\Models\Role;
use App\Models\Subscription;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class DeactivateExpiredSubscriptionsAction
{

    public function handle(): void
    {
        $today = Carbon::today()->toDateString();
        $subscriptions = Subscription::where('status', 'active')
            ->where('end_date', '<',  $today)
            ->with('plan')->get();

        foreach ($subscriptions as $subscription){
            $subscription->status = 'expired';
            $subscription->save();

            $user = User::where('role_id', Role::ADMIN)
                ->where('tenant_id', $subscription->tenant->id)->first();
            Mail::to($user)
                ->send(
                    new SubscriptionExpired(
                        $subscription,
                        $user,
                    )
                );
        }
    }
}
