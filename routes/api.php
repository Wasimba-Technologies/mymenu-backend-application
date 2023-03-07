<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\MenuItemController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\PlanController;
use App\Http\Controllers\Api\QRCodeController;
use App\Http\Controllers\Api\RestaurantController;
use App\Http\Controllers\Api\TableController;
use Illuminate\Http\Request;
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

Route::post('auth/register', [AuthController::class, 'register']);
Route::post('auth/login', [AuthController::class, 'login']);


Route::middleware(['auth:sanctum'])->group(
    function (){
        Route::apiResource(
            'tenants', RestaurantController::class
        );
        Route::apiResource(
            'menus', MenuController::class
        );
        Route::apiResource(
            'menu_items', MenuItemController::class
        );
        Route::apiResource(
            'tables', TableController::class
        );
        Route::apiResource(
            'orders', OrderController::class
        );
        Route::apiResource(
            'plans', PlanController::class
        );
        Route::post('/generate_qr', [QRCodeController::class, 'generateQRCode']);
        Route::post('/auth/logout', [AuthController::class, 'logout']);

    }
);

Route::middleware('api')->get('/user', function (Request $request) {
    return $request->user();
});
