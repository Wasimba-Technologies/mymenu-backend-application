<?php

namespace App\Console\Commands;

use App\Mail\SubscriptionExpired;
use App\Mail\SubscriptionExpiringSoon;
use App\Models\Plan;
use App\Models\Role;
use App\Models\Subscription;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendSubscriptionExpiryReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-subscription-expiry-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        //Send Notification of Expired accounts
        $today = Carbon::today()->toDateString();
        $expired_subscriptions = Subscription::where('status', 'active')
            ->where('end_date', '<',  $today)
            ->with('plan')->get();

        if ($expired_subscriptions){
            foreach ($expired_subscriptions as $subscription){
                $subscription->status = 'expired';
                $subscription->tenant->plan_id = Plan::FREE_PLAN; // Reset to Free Plan
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

        //Send Reminders to Soon expiring subscriptions

        $date_next_seven_days = Carbon::today()->addDays(7);
        $subscriptions = Subscription::where('status', 'active')
            ->where('end_date', '=',  $date_next_seven_days)
            ->with('plan')->get();

        foreach ($subscriptions as $subscription){
            $user = User::where('role_id', Role::ADMIN)
                ->where('tenant_id', $subscription->tenant->id)->first();
            Mail::to($user)
                ->send(
                    new SubscriptionExpiringSoon(
                        $subscription,
                        $user,
                    )
                );
        }
    }
}
