<?php

namespace App\Http\Requests\Rent;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      schema="Rent/GetRequest",
 *
 *      @OA\Property(property="rentId", type="integer", example="1", description="Идентификатор аренды"),
 * )
 */
class GetRequest extends FormRequest
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
            'rentId' => [
                'required',
                'integer',
                'numeric',
                'exists:rents,id',
            ]
        ];
    }
}
