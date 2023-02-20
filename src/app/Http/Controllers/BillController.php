<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use Illuminate\Http\Request;

class BillController extends Controller
{
    //
    public function setStatus(Request $request) {
        $status = $request->query('status');
        $billId = $request->query('bill');

        $bill = Bill::find($billId);

        $allowedStatuses = array(
            'open',
            'blocked',
            'frozen',
            'closed',
        );

        if ( !$bill ) {
            return response()->json(['message' => "Error. Bill with id $billId is not found"]);
        }

        if ( !in_array($status, $allowedStatuses) ) {
            return response()->json(['message' => "Error. Incorrect status $status"]);
        }

        if ( $bill->status === $status ) {
            return response()->json(['message' => "Error. Bill already has $status status"]);
        }

        $bill->setStatus( $status );
        $bill->save();
        return $bill;
    }
}
