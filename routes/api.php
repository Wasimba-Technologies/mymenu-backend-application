<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AzamPayCallbackController;
use App\Http\Controllers\Api\MenuBrowser;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\MenuItemController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\OrderMenuItemController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\PlanController;
use App\Http\Controllers\Api\PrinterController;
use App\Http\Controllers\Api\QRCodeController;
use App\Http\Controllers\Api\RestaurantController;
use App\Http\Controllers\Api\SocialController;
use App\Http\Controllers\Api\SubscriptionController;
use App\Http\Controllers\Api\TableController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\VerificationController;
use App\Models\Scopes\TenantScope;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


//Public End Points
Route::post('auth/register', [AuthController::class, 'register']);

//Login end points
Route::post('auth/login', [AuthController::class, 'login']);
Route::get('auth/login/{provider}/callback',[SocialController::class, 'callback']);
Route::get('auth/login/{provider}',[SocialController::class, 'redirect']);


Route::post('azampay/checkout/callback', [AzamPayCallbackController::class, 'store']);
Route::get('browse/{id}', [MenuBrowser::class, 'browse']);
Route::apiResource(
    'menus', MenuController::class
)->only('index');

Route::apiResource(
    'menu_items', MenuItemController::class
)->only('index');


Route::apiResource(
    'order_items', OrderMenuItemController::class
)->only(['store','show']);


Route::middleware(['auth:sanctum'])->group(function (){
    Route::post('/verify-otp', [VerificationController::class, 'verify']);
    Route::get('/resend-otp', [VerificationController::class, 'resend']);
});

//Authentication Required endpoints
Route::middleware(['auth:sanctum' ,'verified'])->group(
    function (){

        Route::apiResource(
            'tenants', RestaurantController::class
        );
        Route::apiResource(
            'menus', MenuController::class
        )->except('index');

        Route::apiResource(
            'menu_items', MenuItemController::class
        )->except('index');
        Route::apiResource(
            'tables', TableController::class
        );
        Route::apiResource(
            'orders', OrderController::class
        );

        Route::apiResource(
            'order_items', OrderMenuItemController::class
        )->except(['store','show']);
        Route::apiResource(
            'payments', PaymentController::class
        );
        Route::apiResource(
            'plans', PlanController::class
        );

        Route::apiResource(
            'users', UserController::class
        );

        Route::apiResource(
            'subscriptions', SubscriptionController::class
        );

        Route::get('abilities', function(Request $request) {
            return Cache::remember('abilities', 3600, function () use ($request) {
                return $request->user()->role()->with('permissions')
                    ->get()
                    ->pluck('permissions')
                    ->flatten()
                    ->pluck('name')
                    ->unique()
                    ->values()
                    ->toArray();
            });
//            ->merge($request->user()->user_permissions)
        });

        Route::get('/auth/roles', [AuthController::class, 'getRoles']);
        Route::post('/qr_appearance', [QRCodeController::class, 'store']);
        Route::get('/qr_appearance', [QRCodeController::class, 'showQrFeatures']);
        Route::get('/print/{order}', [PrinterController::class, 'print']);
        Route::get('/print_qr/{table}', [PrinterController::class, 'print_qr']);
        Route::post('/auth/logout', [AuthController::class, 'logout']);
    }
);

Route::middleware('api')->get('/user', function (Request $request) {
    return $request->user();
});
