<?php

namespace App\Services;
use App\Models\Rent;

class RentService
{
    public function open(array $data) {
        $renterId = $data['renter'];
        $vehicleId = $data['vehicle'];

        $rent = new Rent;
        
        $rent->open($renterId, $vehicleId);
        return $rent;
    }

    public function close(array $data) {
        dd($data);
        $rentId = $data['id'];
        $rent = Rent::find($rentId);
        $rent->close();
        return $rent;
    }
}