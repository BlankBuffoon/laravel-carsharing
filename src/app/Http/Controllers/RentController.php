<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use App\Models\Renter;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class RentController extends Controller
{
    //

    public function open(Request $request) {
        $renter = $request->query('renter');
        $vehicle = $request->query('vehicle');

        if (!Renter::find($renter)) {
            return response()->json(['message' => 'Error. Renter in not found']);
        } else if (!Vehicle::find($vehicle)) {
            return response()->json(['message' => 'Error. Vehicle in not found']);
        } else if (Vehicle::find($vehicle)->status != 'expectation') {
            return response()->json(['message' => 'Error. Vehicle can not be rented']);
        }

        $rent = new Rent;
        $rent->open($renter, $vehicle);
        return $rent;
    }

    public function close($id) {
        $rent = Rent::find($id);

        if ($rent->status != 'open') {
            return response()->json(['message' => 'Error. Rent status in not open']);
        } else if ($rent->vehicle->status != 'rented') {
            return response()->json(['message' => 'Error. Vehicle status in not rented']);
        }

        $rent->close();

        return $rent;
    }

}
