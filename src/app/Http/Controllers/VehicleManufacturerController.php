<?php

namespace App\Http\Controllers;

use App\Http\Resources\VehicleManufacturerResourse;
use App\Models\VehicleManufacturer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class VehicleManufacturerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @OA\Get(
     *      path="/api/vehicles/manufacturers",
     *      summary="Получить всех производителей ТС",
     *      description="Получить список всех производителей ТС",
     *      tags={"Производители ТС"},
     *      @OA\Response(
     *          response="200",
     *          description="Возвращает список производителей ТС",
     *      )
     * ),
     *
     * @return JsonResponse
     */
    public function index() : JsonResponse
    {
        return response()->json(VehicleManufacturerResourse::collection(VehicleManufacturer::all()), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @OA\Post(
     *      path="/api/vehicles/manufacturers",
     *      summary="Создать производителя ТС",
     *      description="Создает нового производителя ТС и возвращает его",
     *      tags={"Производители ТС"},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              @OA\Property(property="name", type="string", example="VAG")
     *          ),
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="Возвращает запись созданного производителя ТС",
     *          @OA\JsonContent(ref="#/components/schemas/VehicleManufacturerResourse"),
     *      ),
     *      @OA\Response(
     *          response="422",
     *          description="Неверно переданы данные в запросе",
     *      )
     * ),
     *
     * @param  Request $request
     * @return JsonResponse
     */
    public function store(Request $request) : JsonResponse
    {
        $manufacturer = VehicleManufacturer::create($request->validate([
            'name' => 'required|string|unique:vehicle_manufacturers',
        ]));

        return response()->json(new VehicleManufacturerResourse($manufacturer), 200);
    }

    /**
     * Display the specified resource.
     *
     * @OA\Get(
     *      path="/api/vehicles/manufacturers/{id}",
     *      summary="Получить производителя",
     *      description="Получает производителя ТС по идентификатору и возвращает его",
     *      tags={"Производители ТС"},
     *      @OA\Parameter(
     *          name="id",
     *          description="Идентификатор производителя ТС",
     *          required=true,
     *          in="path",
     *          @OA\Schema(type="integer", example=1)
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="Возвращает запись производителя ТС",
     *          @OA\JsonContent(ref="#/components/schemas/VehicleManufacturerResourse"),
     *      ),
     *      @OA\Response(
     *          response="404",
     *          description="Не найдено",
     *      )
     * ),
     *
     * @param VehicleManufacturer $manufacturer
     * @return JsonResponse
     */
    public function show(VehicleManufacturer $manufacturer) : JsonResponse
    {
        return response()->json(new VehicleManufacturerResourse($manufacturer), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @OA\Patch(
     *      path="/api/vehicles/manufacturers/{id}",
     *      summary="Обновить производителя ТС",
     *      description="Обновляет запись о производителе ТС и возвращает ее",
     *      tags={"Производители ТС"},
     *      @OA\Parameter(
     *          name="id",
     *          description="Идентификатор производителя",
     *          required=true,
     *          in="path",
     *          @OA\Schema(type="integer", example=1)
     *      ),
     *       @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              @OA\Property(property="name", type="string", example="VAG")
     *          ),
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="Возвращает запись производителя ТС",
     *          @OA\JsonContent(ref="#/components/schemas/VehicleManufacturerResourse"),
     *      ),
     *      @OA\Response(
     *          response="404",
     *          description="Не найдено",
     *      ),
     *      @OA\Response(
     *          response="422",
     *          description="Неверно переданы данные в запросе",
     *      )
     * ),
     *
     * @param  Request $request
     * @param  Vehicle $vehicle
     * @return JsonResponse
     */
    public function update(Request $request, VehicleManufacturer $manufacturer) : JsonResponse
    {
        $manufacturer->update($request->validate([
            'name' => [
                'required',
                Rule::unique('vehicle_manufacturers', 'name')->ignore($manufacturer),
            ]
        ]));

        return response()->json(new VehicleManufacturerResourse($manufacturer), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @OA\Delete(
     *      path="/api/vehicles/manufacturers/{id}",
     *      summary="Удалить производителя",
     *      description="Удаляет запись о производителе ТС. Важно! Удаление производителя приведет к удалению ВСЕХ связанных моделей, брендов и ТС",
     *      tags={"Производители ТС"},
     *      @OA\Parameter(
     *          name="id",
     *          description="Идентификатор производителя ТС",
     *          required=true,
     *          in="path",
     *          @OA\Schema(type="integer", example=1)
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="Возвращает сообщение об успешном удалении",
     *          @OA\JsonContent(
     *              example={"message": "Succesfully deleted"}
     *          ),
     *      ),
     *      @OA\Response(
     *          response="404",
     *          description="Неверно передан идентификатор производителя ТС",
     *      )
     * ),
     *
     * @param VehicleManufacturer $manufacturer
     * @return JsonResponse
     */
    public function destroy(VehicleManufacturer $manufacturer)
    {
        $manufacturer->delete();

        return response()->json(['message' => 'Succesfully deleted'], 200);
    }
}
