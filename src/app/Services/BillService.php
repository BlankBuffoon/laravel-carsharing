<?php

namespace App\Services;

use App\Models\Bill;
use App\Models\Renter;
use Illuminate\Http\JsonResponse;

class BillService
{
    /**
     * Получает статус счета
     *
     * @param Bill $renter
     * @return string
     */
    public function getStatus(Bill $bill) : string {
        return $bill->status;
    }

    /**
     * Проверяет имеет ли счет статус(ы)
     *
     * @param Bill $renter
     * @param array $statuses
     * @return bool
     */
    public function checkIsStatus(Bill $bill, array $statuses) : bool {
        if (in_array($this->getStatus($bill), $statuses)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Меняет статус счета
     *
     * @param array $data
     * @return JsonReaponse
     */
    public function setBillStatus(array $data) : JsonResponse {
        $bill = Bill::find($data['billId']);
        $status = $data['status'];

        $allowedStatuses = array(
            'open',
            'blocked',
            'frozen',
            'closed',
        );

        if (!$this->checkIsStatus($bill, $allowedStatuses)) {
            return response()->json(['error' => "Incorrect status '$status'"], 400);
        }

        if ($this->getStatus($bill) === $status) {
            return response()->json(['error' => "Bill already has '$status' status"], 422);
        }

        $bill->setStatus( $status );
        $bill->save();
        return response()->json([$bill], 200);
    }

    public function modificateBalance(Bill $bill, int $modification) {
        $bill->modificateBalance($modification);
    }
}
