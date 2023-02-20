<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Renter;
use Illuminate\Http\Request;

class RenterController extends Controller
{
    //
    public function setDefaultBill(Request $request) {
        $renterId = $request->query('renter');
        $billId = $request->query('bill');

        $renter = Renter::find($renterId);
        $bill = Bill::find($billId);

        if ( !$renter ) {
            return response()->json(['message' => "Error. Renter with id $renterId is not found"]);
        }

        if ( !$bill ) {
            return response()->json(['message' => "Error. Bill with id $billId is not found"]);
        }

        if ( !$renter->bills()->find($billId) ) {
            return response()->json(['message' => "Error. Renter has not bill with id $billId"]);
        }

        if ( $renter->default_bill === $bill->id ) {
            return response()->json(['message' => "Error. Bill with id $billId is already the default bill"]);
        }

        $renter->setDefaultBill($billId);
        $renter->save();
        return $renter;
    }
}
