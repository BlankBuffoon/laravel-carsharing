<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\VehicleController;
use App\Http\Controllers\ManufacturerController;
use App\Http\Controllers\RentController;
use App\Http\Controllers\RenterController;
use App\Http\Controllers\BillController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Getters
Route::any('vehicles/get', [VehicleController::class, 'get']);

// Other Routes

// Rents
Route::prefix('rents')->group(
    function () {
        Route::get('close', [RentController::class, 'close']);
        Route::post('open', [RentController::class, 'open']);
        Route::prefix('get')->group(
            function () {
                Route::get('status/{id}', [RentController::class, 'getStatus']);
                Route::get('open', [RentController::class, 'getOpen']);
                Route::get('closed', [RentController::class, 'getClosed']);
            }
        );
    }
);

Route::apiResource('rents', RentController::class)->only(['show']);

// Renters
Route::get('renters/set/defaultbill', [RenterController::class, 'setDefaultBill']);

// Bills
Route::post('bills/{id}/set/status/', [BillController::class, 'setStatus']);

// Vehicles
Route::apiResource('vehicles', VehicleController::class);
