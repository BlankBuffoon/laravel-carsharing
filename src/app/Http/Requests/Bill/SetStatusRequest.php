<?php

namespace App\Http\Requests\Bill;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      schema="Bill/SetStatusRequest",
 *
 *      @OA\Property(property="billId", type="integer", example="1", description="Идентификатор Счета"),
 *      @OA\Property(property="status", type="string", example="open", description="Статус"),
 * )
 */
class SetStatusRequest extends FormRequest
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
            'billId' => [
                'required',
                'integer',
                'numeric',
                'exists:bills,id',
            ],
            'status' => [
                'required',
                'string',
                'min:1',
                'max:10',
            ],
        ];
    }
}
