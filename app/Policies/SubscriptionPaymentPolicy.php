<?php

namespace App\Policies;

use App\Models\SubscriptionPayment;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SubscriptionPaymentPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('subscription_payments.viewAny');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, SubscriptionPayment $subscriptionPayment): bool
    {
        return $user->hasPermission('subscription_payments.view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermission('subscription_payments.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, SubscriptionPayment $subscriptionPayment): bool
    {
        return $user->hasPermission('subscription_payments.update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, SubscriptionPayment $subscriptionPayment): bool
    {
        return $user->hasPermission('subscription_payments.delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, SubscriptionPayment $subscriptionPayment): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, SubscriptionPayment $subscriptionPayment): bool
    {
        //
    }
}
