<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *      schema="VehicleBrandResourse",
 *      @OA\Property(property="id", type="integer", example="1"),
 *      @OA\Property(property="vehicle_manufacturer_id", type="integer", example="1"),
 *      @OA\Property(property="name", type="string", example="Audi"),
 * )
 */
class VehicleBrandResourse extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request) : array
    {
        return [
            'id' => $this->id,
            'vehicle_manufacturer_id' => $this->vehicle_manufacturer_id,
            'name' => $this->name,
        ];
    }
}
