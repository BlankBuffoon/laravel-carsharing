<?php

namespace App\Http\Requests\Renter;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      schema="Bill/SetDefaultBillRequest",
 *
 *      @OA\Property(property="renterId", type="integer", example="1", description="Идентификатор пользователя"),
 *      @OA\Property(property="billId", type="integer", example="1", description="Идентификатор счета"),
 * )
 */
class SetDeafultBillRequest extends FormRequest
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
            'renterId' => [
                'required',
                'uuid',
                'exists:renters,id,deleted_at,NULL',
            ],
            'billId' => [
                'required',
                'uuid',
                'exists:bills,id,deleted_at,NULL',
            ]
        ];
    }
}
