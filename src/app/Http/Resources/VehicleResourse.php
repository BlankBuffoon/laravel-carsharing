<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VehicleResourse extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request) : array
    {
        return [
            'id' => $this->id,
            "vehicle_model_id" => $this->vehicle_model_id,
            "status" => $this->status,
            "mileage" => $this->mileage,
            "manufacture_year" => $this->manufacture_year,
            "license_plate" => $this->license_plate,
            "price_at_minute" => $this->price_at_minute,
        ];
    }
}
