<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;

class VehicleController extends Controller
{
    //
    public function get() {
        $data = Vehicle::all();
        return response()->json($data);
    }
}
