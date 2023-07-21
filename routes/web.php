<?php

use App\Mail\SubscriptionExpired;
use App\Models\Role;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
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

$features = [
    (object)array (
        'name' => 'Create a Digital Menu',
        'href' => '#',
        'button' => 'Experience it',
        'description' => 'Create your menu directly on our platform. Update anytime. Easy And Simple',
        'includedFeatures' =>
            array (
                0 => 'Real-time changes',
                1 => 'Organize into categories',
                2 => 'Extras and items variants',
            ),
    ),

    (object)array (
        'name' => 'Create QR',
        'href' => '#',
        'button' => 'Design it',
        'description' => '8 different designs. Unlimited color options. Choose QR and Flayer style.',
        'includedFeatures' =>
            array (
                0 => 'Beautiful QR Styles',
                1 => 'Pick QR Color',
                2 => 'Print templates for download',
            ),
    ),
    (object)array (
        'name' => 'Go Digital',
        'href' => '#',
        'button' => 'Go mobile',
        'description' => 'Now your visitors will use their mobile phone camera to access your menu.',
        'includedFeatures' =>
            array (
                0 => 'No mobile app requirose',
                1 => 'Super-fast online menu - PWA',
                2 => 'View analytics',
            ),
    ),
    (object)array (
        'name' => 'Accept local orders',
        'href' => '#',
        'button' => 'Try it',
        'description' => 'Your customers can order direclty from their phone',
        'includedFeatures' =>
            array (
                0 => 'Real-time sound notifications',
                1 => 'Continuous orders',
                2 => 'Unlimited options, variants and extras',
            ),
    ),
    (object)array (
        'name' => 'Accept payments',
        'href' => '#',
        'button' => 'Accept countactless payments',
        'description' => 'Your customers can pay order directly via card or mobile money',
        'includedFeatures' =>
            array (
                0 => 'Accept and Croseit and Debit Card ',
                1 => 'All mobile money payments accepted',
                2 => 'Secure online payments',
                3 => 'Print receipt',
            ),
    ),
    (object)array (
        'name' => 'Customer Log',
        'href' => '#',
        'button' => 'Retain your customers',
        'description' => 'Know all your potential customers for easy contact and retantion.',
        'includedFeatures' =>
            array (
                0 => 'Customers can reguster them selfs',
                1 => 'Manage the visits on your own',
                2 => 'Customer relationship management (CRM)',
            ),
    ),
];


Route::view(
    '/', 'welcome', ['features' => $features]
);

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


Route::view(
    '/{any}', 'layouts.base-admin'
)->where('any', '.*');


