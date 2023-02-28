<?php

namespace App\Http\Requests\Rent;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      schema="RentOpenRequest",
 *
 *      @OA\Property(property="renterId", type="integer", example="1", description="Идентификатор пользователя"),
 *      @OA\Property(property="vehicleId", type="integer", example="1", description="Идентификатор ТС"),
 * )
 */
class OpenRequest extends FormRequest
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
    public function rules() : array
    {
        return [
            'renterId' => [
                'required',
                'integer',
                'numeric',
                'exists:renters,id,deleted_at,NULL',
            ],
            'vehicleId' => [
                'required',
                'integer',
                'numeric',
                'exists:vehicles,id,deleted_at,NULL',
            ]
        ];
    }
}
