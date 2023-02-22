<?php

namespace App\Services;
use App\Models\Vehicle;

class VehicleService
{
    /**
     * Получает статус пользователя
     *
     * @param \App\Models\Vehicle $renter
     * @return string
     */
    public function getStatus(Vehicle $vehicle) : string {
        return $vehicle->status;
    }

    /**
     * Проверяет имеет ли ТС статус(ы)
     *
     * @param \App\Models\Vehicle $vehicle
     * @param array $statuses
     * @return bool
     */
    public function checkIsStatus(Vehicle $vehicle, array $statuses) : bool {
        if (in_array($this->getStatus($vehicle), $statuses)) {
            return true;
        } else {
            return false;
        }
    }
}
