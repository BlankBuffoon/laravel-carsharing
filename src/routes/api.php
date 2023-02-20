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
Route::any('rents/close', [RentController::class, 'close']);
Route::get('rents/open', [RentController::class, 'open']);

Route::get('renters/set/defaultbill', [RenterController::class, 'setDefaultBill']);

Route::get('bills/set/status', [BillController::class, 'setStatus']);

Route::get('rents/get', [RentController::class, 'myMethod']);
