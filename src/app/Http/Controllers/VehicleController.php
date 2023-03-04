<?php

namespace App\Http\Controllers;

use App\Http\Requests\Vehicle\CreateRequest;
use App\Http\Requests\Vehicle\UpdateRequest;
use App\Http\Resources\VehicleResourse;
use App\Models\Vehicle;
use Illuminate\Http\JsonResponse;

class VehicleController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @OA\Get(
     *      path="/api/vehicles/",
     *      summary="Получить все ТС",
     *      description="Получить список ТС",
     *      tags={"ТС"},
     *      @OA\Response(
     *          response="200",
     *          description="Возвращает список ТС",
     *      )
     * ),
     *
     * @return JsonResponse
     */
    public function index() : JsonResponse
    {
        return response()->json(VehicleResourse::collection(Vehicle::all()), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @OA\Post(
     *      path="/api/vehicles/",
     *      summary="Создать ТС",
     *      description="Создает новое ТС и возвращает ее",
     *      tags={"ТС"},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/VehicleCreateRequest")
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="Возвращает запись созданного ТС",
     *          @OA\JsonContent(ref="#/components/schemas/VehicleResourse"),
     *      ),
     *      @OA\Response(
     *          response="422",
     *          description="Неверно переданы данные в запросе",
     *      )
     * ),
     *
     * @param CreateRequest $request
     * @return JsonResponse
     */
    public function store(CreateRequest $request) : JsonResponse
    {
        $newVehicle = Vehicle::create($request->validated());

        return response()->json(new VehicleResourse($newVehicle), 200);
    }

    /**
     * Display the specified resource.
     *
     * @OA\Get(
     *      path="/api/vehicles/{id}",
     *      summary="Получить ТС",
     *      description="Получает ТС по идентификатору и возвращает его",
     *      tags={"ТС"},
     *      @OA\Parameter(
     *          name="id",
     *          description="Идентификатор ТС",
     *          required=true,
     *          in="path",
     *          @OA\Schema(type="string", format="uuid", example="989bd621-3b30-4932-a507-803672fae71d")
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="Возвращает запись ТС",
     *          @OA\JsonContent(ref="#/components/schemas/VehicleResourse"),
     *      ),
     *      @OA\Response(
     *          response="404",
     *          description="ТС не найдено",
     *      )
     * ),
     *
     * @param Vehicle $vehicle
     * @return JsonResponse
     */
    public function show(Vehicle $vehicle) : JsonResponse
    {
        return response()->json(new VehicleResourse($vehicle), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @OA\Patch(
     *      path="/api/vehicles/{id}",
     *      summary="Обновить ТС",
     *      description="Обновляет запись о ТС и возвращает ее",
     *      tags={"ТС"},
     *      @OA\Parameter(
     *          name="id",
     *          description="Идентификатор ТС",
     *          required=true,
     *          in="path",
     *          @OA\Schema(type="integer", format="uuid", example="989bd621-3b30-4932-a507-803672fae71d")
     *      ),
     *      @OA\RequestBody(
     *          required=false,
     *          @OA\JsonContent(ref="#/components/schemas/VehicleUpdateRequest")
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="Возвращает запись ТС",
     *          @OA\JsonContent(ref="#/components/schemas/VehicleResourse"),
     *      ),
     *      @OA\Response(
     *          response="404",
     *          description="Неверно передан идентификатор ТС",
     *      ),
     *      @OA\Response(
     *          response="422",
     *          description="Неверно переданы данные в запросе",
     *      )
     * ),
     *
     * @param  UpdateRequest $request
     * @param  Vehicle $vehicle
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, Vehicle $vehicle) : JsonResponse
    {
        $vehicle->update($request->validated());

        return response()->json(new VehicleResourse($vehicle), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @OA\Delete(
     *      path="/api/vehicles/{id}",
     *      summary="Удалить ТС",
     *      description="Удаляет запись о ТС",
     *      tags={"ТС"},
     *      @OA\Parameter(
     *          name="id",
     *          description="Идентификатор ТС",
     *          required=true,
     *          in="path",
     *          @OA\Schema(type="integer", format="uuid", example="989bd621-3b30-4932-a507-803672fae71d")
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="Возвращает сообщение об успешном удалении",
     *          @OA\JsonContent(
     *              example={"message": "Succesfully destroyed"}
     *          ),
     *      ),
     *      @OA\Response(
     *          response="404",
     *          description="Неверно передан идентификатор ТС",
     *      )
     * ),
     *
     * @param  Vehicle $vehicle
     * @return JsonResponse
     */
    public function destroy(Vehicle $vehicle) : JsonResponse
    {
        $vehicle->delete();

        return response()->json(['message' => 'Succesfully deleted'], 200);
    }
}
