<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *      schema="VehicleResourse",
 *      @OA\Property(property="id", type="integer", example="989bdecd-cd8a-4aae-96d7-1d1ce023f543"),
 *      @OA\Property(property="vehicle_model_id", type="integer", example="4"),
 *      @OA\Property(property="status", type="integer", example="rented"),
 *      @OA\Property(property="mileage", type="integer", example="110"),
 *      @OA\Property(property="manufacture_year", type="integer", example="2019"),
 *      @OA\Property(property="price_at_minute", type="integer", example="90000"),
 * )
 */
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
