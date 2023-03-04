<?php

namespace App\Http\Controllers;

use App\Http\Resources\VehicleBrandResourse;
use App\Models\VehicleBrand;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class VehicleBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @OA\Get(
     *      path="/api/vehicles/brands",
     *      summary="Получить все бренды ТС",
     *      description="Получить список всех брендов ТС",
     *      tags={"Бренды ТС"},
     *      @OA\Response(
     *          response="200",
     *          description="Возвращает список брендов ТС",
     *      )
     * ),
     *
     * @return JsonResponse
     */
    public function index() : JsonResponse
    {
        return response()->json(VehicleBrandResourse::collection(VehicleBrand::all()), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @OA\Post(
     *      path="/api/vehicles/brands",
     *      summary="Создать бренд ТС",
     *      description="Создает новый бренд ТС и возвращает его",
     *      tags={"Бренды ТС"},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              @OA\Property(property="vehicle_manufacturer_id", type="integer", example="1"),
     *              @OA\Property(property="name", type="string", example="Audi")
     *          ),
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="Возвращает запись созданного бренда ТС",
     *          @OA\JsonContent(ref="#/components/schemas/VehicleBrandResourse"),
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
        $brand = VehicleBrand::create($request->validate([
            'vehicle_manufacturer_id' => 'required|numeric|integer|exists:vehicle_manufacturers,id',
            'name' => 'required|string|unique:vehicle_brands',
        ]));

        return response()->json(new VehicleBrandResourse($brand), 200);
    }

    /**
     * Display the specified resource.
     *
     * @OA\Get(
     *      path="/api/vehicles/brands/{id}",
     *      summary="Получить бренд",
     *      description="Получает бренд ТС по идентификатору и возвращает его",
     *      tags={"Бренды ТС"},
     *      @OA\Parameter(
     *          name="id",
     *          description="Идентификатор бренда ТС",
     *          required=true,
     *          in="path",
     *          @OA\Schema(type="integer", example=1)
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="Возвращает запись бренда ТС",
     *          @OA\JsonContent(ref="#/components/schemas/VehicleBrandResourse"),
     *      ),
     *      @OA\Response(
     *          response="404",
     *          description="Не найдено",
     *      )
     * ),
     *
     * @param VehicleBrand $brand
     * @return JsonResponse
     */
    public function show(VehicleBrand $brand) : JsonResponse
    {
        return response()->json(new VehicleBrandResourse($brand), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @OA\Patch(
     *      path="/api/vehicles/brands/{id}",
     *      summary="Обновить бренд ТС",
     *      description="Обновляет запись о бренде ТС и возвращает ее",
     *      tags={"Бренды ТС"},
     *      @OA\Parameter(
     *          name="id",
     *          description="Идентификатор бренда",
     *          required=true,
     *          in="path",
     *          @OA\Schema(type="integer", example=1)
     *      ),
     *       @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              @OA\Property(property="vehicle_manufacturer_id", type="integer", example="1"),
     *              @OA\Property(property="name", type="string", example="Audi")
     *          ),
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="Возвращает запись бренда ТС",
     *          @OA\JsonContent(ref="#/components/schemas/VehicleBrandResourse"),
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
    public function update(Request $request, VehicleBrand $brand) : JsonResponse
    {
        $brand->update($request->validate([
            'vehicle_manufacturer_id' => 'required|numeric|integer|exists:vehicle_manufacturers,id',
            'name' => [
                Rule::unique('vehicle_brands', 'name')->ignore($brand),
            ]
        ]));

        return response()->json(new VehicleBrandResourse($brand), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @OA\Delete(
     *      path="/api/vehicles/brands/{id}",
     *      summary="Удалить бренд",
     *      description="Удаляет запись о бренде ТС. Важно! Удаление бренда приведет к удалению ВСЕХ связанных моделей и ТС",
     *      tags={"Бренды ТС"},
     *      @OA\Parameter(
     *          name="id",
     *          description="Идентификатор бренда ТС",
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
     *          description="Не найдено",
     *      )
     * ),
     *
     * @param VehicleBrand $brand
     * @return JsonResponse
     */
    public function destroy(VehicleBrand $brand)
    {
        $brand->delete();

        return response()->json(['message' => 'Succesfully deleted'], 200);
    }
}
