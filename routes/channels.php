<?php

use App\Models\Role;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('subscriptions.{subscriptionId}', function (User $user, int $subscriptionId) {
    return $user->whereRoleId(Role::ADMIN) && ($user->tenant_id === Subscription::findOrNew($subscriptionId)->tenant_id);
});
