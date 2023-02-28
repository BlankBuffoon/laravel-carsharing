<?php

namespace App\Http\Controllers;

use App\Http\Requests\Rent\CloseRequest;
use App\Http\Requests\Rent\GetRequest;
use App\Http\Requests\Rent\OpenRequest;
use App\Models\Rent;
use App\Models\Renter;
use App\Services\RentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RentController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/rents/get",
     *      summary="Получить аренду",
     *      description="Получить запись об аренде по идентификатору",
     *      tags={"Аренда"},
     *      @OA\Parameter(
     *          name="rentId",
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
     *          description="Возвращает запись аренды",
     *      ),
     *      @OA\Response(
     *          response="422",
     *          description="Неверно переданы данные в запросе",
     *      )
     * ),
     *
     * @param GetRequest $request
     * @return JsonResponse
     */
    public function get(GetRequest $request) : JsonResponse {
        $data = $request->validated();

        $rent = Rent::find($data['rentId']);

        return response()->json([$rent], 200);
    }

    /**
     * Получает статус аренды
     *
     * @OA\Get(
     *      path="/api/rents/get/status/{id}",
     *      summary="Получить статус аренды",
     *      description="Получить статус аренды по идентификатору",
     *      tags={"Аренда"},
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="Идентификатор аренды",
     *          required=true,
     *          @OA\Schema(
     *              type="integer",
     *              example="1"
     *          )
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="Возвращает статус аренды",
     *          @OA\JsonContent(
     *              example={"status": "closed"}
     *          ),
     *      ),
     *      @OA\Response(
     *          response="404",
     *          description="Неверно передан идентификатор",
     *      )
     * ),
     *
     * @param RentService $service
     * @param int $id
     * @return JsonResponse
     */
    public function getStatus(RentService $service, int $id) : JsonResponse {
        $rent = Rent::findOrFail($id);

        return response()->json(['status' => $service->getStatus($rent)], 200);
    }

    /**
     * @OA\Get(
     *      path="/api/rents/get/open",
     *      summary="Получить открытые аренды",
     *      description="Получить аренды со статусом 'открытая'",
     *      tags={"Аренда"},
     *      @OA\Response(
     *          response="200",
     *          description="Возвращает список аренд",
     *      ),
     *      @OA\Response(
     *          response="422",
     *          description="Неверно переданы данные в запросе",
     *      )
     * ),
     *
     * @return JsonResponse
     */
    public function getOpen() : JsonResponse {
        $rents = Rent::where('status', 'open')->get();

        return response()->json($rents, 200);
    }

    /**
     * @OA\Get(
     *      path="/api/rents/get/close",
     *      summary="Получить закрытые аренды",
     *      description="Получить аренды со статусом 'закрытая'",
     *      tags={"Аренда"},
     *      @OA\Response(
     *          response="200",
     *          description="Возвращает список аренд",
     *      ),
     *      @OA\Response(
     *          response="422",
     *          description="Неверно переданы данные в запросе",
     *      )
     * ),
     *
     * @return JsonResponse
     */
    public function getClosed() : JsonResponse {
        $rents = Rent::where('status', 'closed')->get();

        return response()->json($rents, 200);
    }

    /**
     * @OA\Post(
     *      path="/api/rents/open",
     *      summary="Открыть аренду",
     *      description="Взять машину в аренду для заданного пользователя и открыть аренду",
     *      tags={"Аренда"},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/RentOpenRequest")
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="Возвращает запись созданной аренды",
     *      ),
     *      @OA\Response(
     *          response="403",
     *          description="Статус пользователя или ТС не позволяет открыть аренду",
     *      ),
     *      @OA\Response(
     *          response="422",
     *          description="Неверно переданы данные в запросе",
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
     *          name="rentId",
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
     *      ),
     *      @OA\Response(
     *          response="422",
     *          description="Неверно переданы данные в запросе",
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
