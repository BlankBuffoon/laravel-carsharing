<?php

namespace App\Services;

use App\Enums\Bill\BillStatus;
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
     * @param Renter $renter Связанный пользователь
     * @return string Статус
     */
    public function getStatus(Renter $renter) : string {
        return $renter->status;
    }

    /**
     * Проверяет имеет ли пользователь статус(ы)
     * (Будет удалена после того как удостоверюсь что ничто не сломается)
     *
     * @param Renter $renter Пользователь
     * @param array $statuses Массив статусов
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
     * @param array $data Массив данных из запроса
     * @return JsonResponse
     */
    public function setdefaultBill(array $data) : JsonResponse {
        $renter = Renter::find($data['renterId']);
        $bill = Bill::find($data['billId']);

        $badBillStatuses = [
            BillStatus::Frozen,
            BillStatus::Closed,
            BillStatus::Blocked,
        ];

        // Проверяем что у пользователя действительно есть выбранный счет
        if (!$renter->bills()->find($bill->id)) {
            return response()->json(['error' => "Renter has not bill with id '$bill->id'"], 422);
        }

        // Проверяем что этот счет уже не выбран
        if ($renter->default_bill === $bill->id) {
            return response()->json(['error' => "Bill with id '$bill->id' is already the default bill"], 422);
        }

        // Проверяем статусы пользователя
        if (in_array($bill->status, $badBillStatuses)) {
            return response()->json(['error' => "Bill with status '$bill->status' cannot be selected as the default bill"], 400);
        }

        // if ($this->billService->checkIsStatus($bill, ['frozen', 'closed', 'blocked'])) {
        //     return response()->json(['error' => "Bill with status '$bill->status' cannot be selected as the default bill"], 400);
        // }

        $renter->setDefaultBill($bill->id);
        $renter->save();
        return response()->json([$renter], 200);
    }

     /**
     * Проверяет есть ли у пользователя счет по умолчанию
     *
     * @param Renter $renter Пользователь
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
     * (Исправить)
     *
     * @param Renter $renter Пользователь
     * @return mixed
     */
    public function checkBalanceOnDefaultBill(Renter $renter) : mixed {
        if ($renter->default_bill) {
            return Bill::find($renter->default_bill)->balance;
        } else {
            return null;
        }
    }
}
