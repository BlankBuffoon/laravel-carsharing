<?php

namespace App\Http\Controllers;

use App\Http\Requests\Renter\SetDeafultBillRequest;
use App\Services\RenterService;

class RenterController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/renters/set/defaultbill",
     *      summary="Изменить счет по умолчанию",
     *      description="Изменяет выбранный по умолчанию счет для конкретного пользователя",
     *      tags={"Пользователи"},
     *      @OA\Parameter(
     *          name="renterId",
     *          in="query",
     *          description="Идентификатор пользователя",
     *          required=true,
     *          @OA\Schema(
     *              type="integer",
     *              example="1"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="billId",
     *          in="query",
     *          description="Идентификатор счета",
     *          required=true,
     *          @OA\Schema(
     *              type="integer",
     *              example="1"
     *          )
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="Возвращает пользователя",
     *      ),
     *      @OA\Response(
     *          response="400",
     *          description="Статус счета не позволяет выбрать его основным",
     *          @OA\JsonContent(example={"error": "Bill with status 'blocked' cannot be selected as the default bill"}),
     *      ),
     *      @OA\Response(
     *          response="422",
     *          description="Неверно переданы данные в запросе или произошла ошибка при изменении статуса счета",
     *          @OA\JsonContent(example={"error": "Renter has not bill with id '1'"}),
     *      )
     * ),
     *
     * @param SetDeafultBillRequest $request
     * @param RenterService $service
     * @return \Illuminate\Http\Response
     */
    public function setDefaultBill(SetDeafultBillRequest $request, RenterService $service) {
        $data = $request->validated();

        return $service->setDefaultBill($data);
    }
}
