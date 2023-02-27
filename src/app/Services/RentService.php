<?php

namespace App\Services;

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
        $renter = Renter::findOrFail($data['renterId']);
        $vehicle = Vehicle::findOrFail($data['vehicleId']);

        $badRenterStatuses = array(
            'frozen',
            'blocked',
        );

        if ($this->renterService->checkIsStatus($renter, $badRenterStatuses)) {
            return response()->json(["error" => "Renter with id '$renter->id' has '$renter->status' status"], 403);
        }

        if (!$this->vehicleService->checkIsStatus($vehicle, ['expectation'])) {
            return response()->json(["error" => "Vehicle with id '$vehicle->id' can not be rented"], 403);
        }

        if (!$this->renterService->checkDefaultBill($renter)) {
            return response()->json(["error" => "Renter does not main bill account"], 403);
        }

        if ($this->renterService->checkBalanceOnDefaultBill($renter) < 500000) {
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

        if (!$this->checkIsStatus($rent, ['open'])) {
            return response()->json(["error" => "Rent status in not open"], 403);
        }

        if (!$this->vehicleService->checkIsStatus($vehicle, ["rented"])) {
            return response()->json(["error" => "Vehicle status is not rented"], 403);
        }

        if (!$this->renterService->checkDefaultBill($renter)) {
            return response()->json(['error' => "Renter with id '$renter->id' dont have default bill"], 400);
        } else {
            $bill = Bill::find($renter->default_bill);
        }

        $rent->close();

        $total_price = $rent->total_price;
        $reason = "payment for rent №" . $rent->id;

        $this->billService->modificateBalance($bill, $renter, -$total_price, $reason);

        return response()->json($rent, 200);
    }
}
