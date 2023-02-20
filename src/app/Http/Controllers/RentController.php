<?php

namespace App\Http\Controllers;

use App\Http\Requests\Rent\CloseRequest;
use App\Http\Requests\Rent\MyRequest;
use App\Http\Requests\Rent\OpenRequest;
use App\Models\Rent;
use App\Models\Renter;
use App\Models\Vehicle;
use App\Services\RentService;
use Illuminate\Http\Request;

class RentController extends Controller
{
    //

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function open(OpenRequest $request, RentService $service) {
        $data = $request->validated();

        return response()->json($service->open($data), 200);
    }

    public function close(CloseRequest $request, RentService $service) {
        $data = $request->validated();
        
        return response()->json($service->close($data), 200);
    }

    public function myMethod(MyRequest $request) {
        $request->validated();
    }
}
