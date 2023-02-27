<?php

namespace App\Http\Requests\Vehicle;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      schema="VehicleUpdateRequest",
 *
 *      @OA\Property(property="vehicle_model_id", type="integer", example="1", description="Идентификатор модели ТС"),
 *      @OA\Property(property="status", type="string", example="maintenance", description="Статус ТС"),
 *      @OA\Property(property="mileage", type="integer", example="4300", description="Пробег ТС"),
 *      @OA\Property(property="manufacture_year", type="integer", example="2010", description="Год производства ТС"),
 *      @OA\Property(property="location", type="string", example="-41.201 -59.8371", description="Координаты ТС"),
 *      @OA\Property(property="license_plate", type="string", example="А999МР 179", description="Гос. Номер ТС"),
 *      @OA\Property(property="price_at_minute", type="integer", example="400000", description="Цена в копейках за минуту аренды ТС"),
 * )
 */
class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'vehicle_model_id' => 'integer|numeric|exists:vehicle_models,id',
            'status' => 'string',
            'mileage' => 'integer|numeric',
            'manufacture_year' => 'integer|numeric|digits:4',
            'location' => [
                'string',
                'regex:/^\-\d{2}\.\d{1,4}\ \-\d{2}\.\d{1,4}$/'
            ],
            'license_plate' => [
                'string',
                'unique:vehicles,license_plate',
                'regex:/^[АВЕКМНОРСТУ]\d{3}[АВЕКМНОРСТУ]{2}\ \d{2,3}$/u'
            ],
            'price_at_minute' => 'integer|numeric',
        ];
    }
}
