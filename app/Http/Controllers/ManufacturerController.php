<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manufacturer;

class ManufacturerController extends Controller
{
    //
    public function get() {
        $data = Manufacturer::all();
        return response()->json($data);
    }
}
