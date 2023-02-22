<?php

namespace App\Http\Controllers;

use App\Http\Requests\Bill\SetStatusRequest;
use App\Services\BillService;

class BillController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/bills/set/status",
     *      summary="Изменить статус счета",
     *      description="Изменяет статус выбранного счета",
     *      tags={"Счета"},
     *      @OA\Parameter(
     *          name="billId",
     *          in="query",
     *          description="Идентификатор Счета",
     *          required=true,
     *          @OA\Schema(
     *              type="integer",
     *              example="1"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="status",
     *          in="query",
     *          description="Статус",
     *          required=true,
     *          @OA\Schema(
     *              type="string",
     *              example="blocked"
     *          )
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="Возвращает измененный счет",
     *      ),
     *      @OA\Response(
     *          response="400",
     *          description="Переданный статус неверен",
     *          @OA\JsonContent(example={"error": "Incorrect status 'qwerty'"}),
     *      ),
     *      @OA\Response(
     *          response="422",
     *          description="Неверно переданы данные в запросе или произошла ошибка при изменении статуса счета",
     *          @OA\JsonContent(example={"error": "Bill already has 'open' status"}),
     *      )
     * ),
     *
     * @param SetStatusRequest $request
     * @param BillService $service
     * @return \Illuminate\Http\Response
     */
    public function setStatus(SetStatusRequest $request, BillService $service) {
        $data = $request->validated();

        return $service->setBillStatus($data);
    }
}
