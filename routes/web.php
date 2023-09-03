<?php

use App\Http\Controllers\WelcomeController;
use App\Mail\SubscriptionExpired;
use App\Models\Role;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
$pricing = [
    'tiers' =>
        (object)array (
            0 =>
                (object)array (
                    'title' => 'Free',
                    'price' => 0,
                    'frequency' => '/month',
                    'description' => 'If you run a small restaurant or bar, or just need the basics, this plan is great.',
                    'features' =>
                        array (
                            0 => 'Full access to QR tool',
                            1 => ' Access to the menu creation tool',
                            2 => 'Unlimited views',
                            3 => '30 items in the menu',
                            4 => 'Community support',
                        ),
                    'cta' => 'Monthly billing',
                    'mostPopular' => false,
                ),
            1 =>
                (object)array (
                    'title' => 'Starter',
                    'price' => 9,
                    'frequency' => '/month',
                    'description' => 'For bigger restaurants and bars. Offer a full menu. Limitless plan.',
                    'features' =>
                        array (
                            0 => 'Full access to QR tool',
                            1 => ' Access to the menu creation tool',
                            2 => 'Unlimited views',
                            3 => 'Unlimited items in the menu',
                            4 => '300 orders per month',
                            5 => 'Dedicated support',
                        ),
                    'cta' => 'Monthly billing',
                    'mostPopular' => true,
                ),
            2 =>
                (object)array (
                    'title' => 'Pro',
                    'price' => 49,
                    'frequency' => '/month',
                    'description' => 'Dedicated support and infrastructure for your company.',
                    'features' =>
                        array (
                            0 => 'Full access to QR tool',
                            1 => ' Access to the menu creation tool',
                            2 => 'Unlimited views',
                            3 => 'Unlimited items in the menu',
                            4 => 'Unlimited orders',
                            5 => 'Dedicated support',
                        ),
                    'cta' => 'Monthly billing',
                    'mostPopular' => false,
                ),
        ),
];




Route::get('/',[WelcomeController::class, 'index']);

Route::view(
    '/pricing', 'pricing', ['pricing' => $pricing,]
);
Route::view(
    '/support', 'support'
);

Route::view(
    '/register', 'register'
);

Route::view(
    '/login', 'login'
);


Route::get('/mailable', function () {
    $subscription = Subscription::find(1);
    $user = User::where('tenant_id', $subscription->tenant->id)->where('role_id', Role::ADMIN)->first();
    return new SubscriptionExpired($subscription, $user);
});



