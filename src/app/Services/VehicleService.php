<?php

namespace App\Services;
use App\Models\Vehicle;

class VehicleService
{
    /**
     * Получает статус пользователя
     *
     * @param Vehicle $vehicle
     * @return string
     */
    public function getStatus(Vehicle $vehicle) : string {
        return $vehicle->status;
    }

    /**
     * Проверяет имеет ли ТС статус(ы)
     * (Будет удалена после того как удостоверюсь что ничто не сломается)
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
