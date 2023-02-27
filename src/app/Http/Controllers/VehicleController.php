<?php

namespace App\Http\Controllers;

use App\Http\Requests\Vehicle\CreateRequest;
use App\Http\Requests\Vehicle\UpdateRequest;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use Illuminate\Http\JsonResponse;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Vehicle::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $newVehicle = Vehicle::create($request->validated());

        return response()->json([
            'message' => 'Succesfully created',
            $newVehicle->id => $newVehicle
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vehicle = Vehicle::findOrFail($id);

        return response()->json([
            $vehicle->id => $vehicle
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Vehicle $vehicle)
    {
        $vehicle->update($request->validated());

        return response()->json([
            'message' => 'Succesfully updated',
            $vehicle->id => $vehicle
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Vehicle $vehicle
     * @return JsonResponse
     */
    public function destroy(Vehicle $vehicle) : JsonResponse
    {
        $vehicle->delete();

        return response()->json(['message' => 'Succesfully destroyed'], 200);
    }

    /**
     * Получает все записи из модели
     *
     * @return \Illuminate\Http\Response
     */
    public function get() : JsonResponse {
        $data = Vehicle::all();
        return response()->json([$data], 200);
    }
}
