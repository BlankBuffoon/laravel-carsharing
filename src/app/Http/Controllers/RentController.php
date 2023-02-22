<?php

namespace App\Http\Controllers;

use App\Http\Requests\Rent\CloseRequest;
use App\Http\Requests\Rent\OpenRequest;
use App\Services\RentService;

class RentController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/rents/open",
     *      summary="Открыть аренду",
     *      description="Взять машину в аренду для заданного пользователя и открыть аренду",
     *      tags={"Аренда"},
     *      @OA\Parameter(
     *          name="renter",
     *          in="query",
     *          description="Идентификатор пользователя",
     *          required=true,
     *          @OA\Schema(
     *              type="integer",
     *              example="1"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="vehicle",
     *          in="query",
     *          description="Идентификатор ТС",
     *          required=true,
     *          @OA\Schema(
     *              type="integer",
     *              example="1"
     *          )
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="Возвращает запись созданной аренды",
     *          @OA\JsonContent(example=""),
     *      ),
     *      @OA\Response(
     *          response="403",
     *          description="Статус пользователя или ТС не позволяет открыть аренду",
     *          @OA\JsonContent(example=""),
     *      ),
     *      @OA\Response(
     *          response="422",
     *          description="Неверно переданы данные в запросе",
     *          @OA\JsonContent(example=""),
     *      )
     * ),
     *
     * @param OpenRequest $request
     * @param RentService $service
     * @return \Illuminate\Http\Response
     */
    public function open(OpenRequest $request, RentService $service) {
        $data = $request->validated();

        return $service->open($data);
    }

    /**
     * @OA\Get(
     *      path="/api/rents/close",
     *      summary="Закрыть аренду",
     *      description="Закрыть аренду по идентификатору",
     *      tags={"Аренда"},
     *      @OA\Parameter(
     *          name="id",
     *          in="query",
     *          description="Идентификатор аренды",
     *          required=true,
     *          @OA\Schema(
     *              type="integer",
     *              example="1"
     *          )
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="Возвращает запись закрытой аренды",
     *      ),
     *      @OA\Response(
     *          response="403",
     *          description="Статус аренды или статус ТС не позволяет закрыть аренду",
     *          @OA\JsonContent(example=""),
     *      ),
     *      @OA\Response(
     *          response="422",
     *          description="Неверно переданы данные в запросе",
     *          @OA\JsonContent(example=""),
     *      )
     * ),
     *
     * @param CloseRequest $request
     * @param RentService $service
     * @return \Illuminate\Http\Response
     */
    public function close(CloseRequest $request, RentService $service) {
        $data = $request->validated();

        return $service->close($data);
    }
}
