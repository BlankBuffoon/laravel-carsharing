<?php

namespace App\Http\Requests\Vehicle;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'vehicle_model_id' => 'required|integer|numeric|exists:vehicle_models,id',
            'status' => 'string',
            'mileage' => 'required|integer|numeric',
            'manufacture_year' => 'required|integer|numeric|digits:4',
            'location' => [
                'required',
                'string',
                'regex:/^\-\d{2}\.\d{1,4}\ \-\d{2}\.\d{1,4}$/'
            ],
            'license_plate' => [
                'required',
                'string',
                'unique:vehicles,license_plate',
                'regex:/^[АВЕКМНОРСТУ]\d{3}[АВЕКМНОРСТУ]{2}\ \d{2,3}$/u'
            ],
            'price_at_minute' => 'required|integer|numeric',
        ];
    }
}
