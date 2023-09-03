<?php

use App\Http\Controllers\PricingController;
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


Route::get('/',[WelcomeController::class, 'index']);
Route::get('/pricing', [PricingController::class, 'index']);
Route::view('/support', 'support');
Route::view('/register', 'register');
Route::view('/login', 'login');


Route::get('/mailable', function () {
    $subscription = Subscription::find(1);
    $user = User::where('tenant_id', $subscription->tenant->id)->where('role_id', Role::ADMIN)->first();
    return new SubscriptionExpired($subscription, $user);
});



