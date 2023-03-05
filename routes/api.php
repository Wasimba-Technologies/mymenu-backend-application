<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\MenuItemController;
use App\Http\Controllers\Api\RestaurantController;
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


Route::middleware(['api'])->group(
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
        Route::post('/auth/logout', [AuthController::class, 'logout']);
    }
);

Route::middleware('api')->get('/user', function (Request $request) {
    return $request->user();
});
