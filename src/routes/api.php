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
        Route::get('open', [RentController::class, 'open']);
        Route::prefix('get')->group(
            function () {
                Route::get('/', [RentController::class, 'get']);
                Route::get('status', [RentController::class, 'getStatus']);
                Route::get('open', [RentController::class, 'getOpen']);
                Route::get('closed', [RentController::class, 'getClosed']);
            }
        );
    }
);

// Renters
Route::get('renters/set/defaultbill', [RenterController::class, 'setDefaultBill']);

// Bills
Route::get('bills/set/status', [BillController::class, 'setStatus']);
