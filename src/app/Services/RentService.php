<?php

namespace App\Services;

use App\Enums\Rent\RentStatus;
use App\Enums\Renter\RenterStatus;
use App\Enums\Vehicle\VehicleStatus;
use App\Models\Bill;
use App\Models\Rent;
use App\Models\Renter;
use App\Models\Vehicle;
use Illuminate\Http\JsonResponse;

class RentService
{
    protected $renterService;
    protected $vehicleService;
    protected $billService;
    protected $transactionService;

    public function __construct(RenterService $renterService, VehicleService $vehicleService, BillService $billService, TransactionService $transactionService) {
        $this->renterService = $renterService;
        $this->vehicleService = $vehicleService;
        $this->billService = $billService;
        $this->transactionService = $transactionService;
    }

    /**
     * Получает статус пользователя
     *
     * @param Rent $renter Пользователь
     * @return string
     */
    public function getStatus(Rent $rent) : string {
        return $rent->status;
    }

    /**
     * Получает статус пользователя
     * (После добавления Enum'ов потребность в функции пропала. Будет удалена после того как удостоверюсь что ничто не сломается)
     *
     * @param Rent $renter Пользователь
     * @param array $statuses Статус(ы) для поиска
     * @return string
     */
    public function checkIsStatus(Rent $rent, array $statuses) : bool {
        if (in_array($this->getStatus($rent), $statuses)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Открывает аренду
     *
     * @param array $data
     * @return JsonResponce
     */
    public function open(array $data) : JsonResponse {
        $renter = Renter::find($data['renterId']);
        $vehicle = Vehicle::find($data['vehicleId']);

        $badRenterStatuses = array(
            RenterStatus::Frozen,
            RenterStatus::Blocked,
        );

        if (in_array($renter->status, $badRenterStatuses)) {
            return response()->json(["error" => "Renter with id '$renter->id' has '$renter->status' status"], 403);
        }

        if (!in_array($vehicle->status, [VehicleStatus::Expectation])) {
            return response()->json(["error" => "Vehicle with id '$vehicle->id' can not be rented"], 403);
        }

        // Убрать после тестов
        // if ($this->renterService->checkIsStatus($renter, $badRenterStatuses)) {
        //     return response()->json(["error" => "Renter with id '$renter->id' has '$renter->status' status"], 403);
        // }

        // Убрать после тестов
        // if (!$this->vehicleService->checkIsStatus($vehicle, [VehicleStatus::Expectation])) {
        //     return response()->json(["error" => "Vehicle with id '$vehicle->id' can not be rented"], 403);
        // }

        if (!$this->renterService->checkDefaultBill($renter)) {
            return response()->json(["error" => "Renter does not have default bill account"], 403);
        }

        if ($this->renterService->checkBalanceOnDefaultBill($renter) < 100000) {
            return response()->json(["error" => "Renter does not have enough money in the main bill account"], 403);
        }

        $rent = new Rent;
        $rent->open($renter->id, $vehicle->id);

        return response()->json($rent, 200);
    }

    /**
     * Закрывает аренду
     *
     * @param array $data
     * @return JsonResponce
     */
    public function close(array $data) : JsonResponse {
        $rent = Rent::find($data['rentId']);
        $renter = Renter::find($rent->renter_id);
        $vehicle = Vehicle::find($rent->vehicle_id);

        if (!in_array($rent->status, [RentStatus::Open])) {
            return response()->json(["error" => "Rent status in not open"], 403);
        }

        if (!in_array($vehicle->status, [VehicleStatus::Rented])) {
            return response()->json(["error" => "Vehicle status is not rented"], 403);
        }

        // Убрать после тестов
        // if (!$this->checkIsStatus($rent, [RentStatus::Open])) {
        //     return response()->json(["error" => "Rent status in not open"], 403);
        // }

        // Убрать после тестов
        // if (!$this->vehicleService->checkIsStatus($vehicle, [VehicleStatus::Rented])) {
        //     return response()->json(["error" => "Vehicle status is not rented"], 403);
        // }

        if (!$this->renterService->checkDefaultBill($renter)) {
            return response()->json(['error' => "Renter with id '$renter->id' dont have default bill"], 400);
        } else {
            $bill = Bill::find($renter->default_bill);
        }

        // Закрываем аренду
        $rent->close();

        // Высчитываем цену по которую необходимо вычесть со счета
        $total_price = $rent->total_price;
        $reason = "payment for rent №" . $rent->id;

        // Модифицируем баланс
        $this->billService->modificateBalance($bill, $renter, -$total_price, $reason);

        return response()->json($rent, 200);
    }
}
