<?php

namespace App\Services;

use App\Exceptions\JsonException;
use App\Models\Bill;
use App\Models\Renter;
use Illuminate\Http\JsonResponse;

class RenterService
{
    protected $billService;

    public function __construct(BillService $billService) {
        $this->billService = $billService;
    }

    /**
     * Получает статус пользователя
     *
     * @param Renter $renter
     * @return string
     */
    public function getStatus(Renter $renter) : string {
        return $renter->status;
    }

    /**
     * Проверяет имеет ли пользователь статус(ы)
     *
     * @param Renter $renter
     * @param array $statuses
     * @return bool
     */
    public function checkIsStatus(Renter $renter, array $statuses) : bool {
        if (in_array($this->getStatus($renter), $statuses)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Устанавливает счет по умолчанию
     *
     * @param array $data
     * @return JsonResponse
     */
    public function setdefaultBill(array $data) : JsonResponse {
        $renter = Renter::find($data['renterId']);
        $bill = Bill::find($data['billId']);

        if ($renter->bills()->find($bill->id)) {
            return response()->json(['error' => "Renter has not bill with id '$bill->id'"], 422);
        }

        if ($renter->default_bill === $bill->id) {
            return response()->json(['error' => "Bill with id '$bill->id' is already the default bill"], 422);
        }

        if ($this->billService->checkIsStatus($bill, ['frozen', 'closed', 'blocked'])) {
            return response()->json(['error' => "Bill with status '$bill->status' cannot be selected as the default bill"], 400);
        }

        $renter->setDefaultBill($bill->id);
        $renter->save();
        return response()->json([$renter], 200);
    }

     /**
     * Проверяет есть ли у пользователя счет по умолчанию
     *
     * @param Renter $renter
     * @return bool
     */
    public function checkDefaultBill(Renter $renter) : bool {
        if ($renter->default_bill) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Проверяет баланс у пользователя на счету по умолчанию
     *
     * @param Renter $renter
     * @return int
     */
    public function checkBalanceOnDefaultBill(Renter $renter) : int {
        if ($renter->default_bill) {
            return Bill::find($renter->default_bill)->balance;
        } else {
            throw new \Exception("Renter have not a default bill");
        }
    }
}
