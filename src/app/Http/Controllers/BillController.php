<?php

namespace App\Http\Controllers;

use App\Http\Requests\Bill\SetStatusRequest;
use App\Models\Bill;
use App\Services\BillService;

class BillController extends Controller
{
    /**
     * Запрос на изменение статуса счета
     *
     * @OA\Post(
     *      path="/api/bills/{id}/set/status/",
     *      summary="Изменить статус счета",
     *      description="Изменяет статус выбранного счета",
     *      tags={"Счета"},
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="Идентификатор Счета",
     *          required=true,
     *          @OA\Schema(
     *              type="integer",
     *              example="1"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/BillSetStatusRequest")
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="Возвращает измененный счет",
     *      ),
     *      @OA\Response(
     *          response="404",
     *          description="Счет по заданному идентификатору не найден",
     *      ),
     *      @OA\Response(
     *          response="422",
     *          description="Неверно переданы данные в запросе или счет уже имеет запрашиваемый статус",
     *          @OA\JsonContent(example={"error": "Bill already has 'open' status"}),
     *      )
     * ),
     *
     * @param SetStatusRequest $request
     * @param BillService $service
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function setStatus(SetStatusRequest $request, BillService $service, int $id) {
        $data = $request->validated();
        $bill = Bill::find($id);

        return $service->setBillStatus($bill, $data);
    }
}
