<?php

namespace App\Http\Requests\Bill;

use App\Enums\Bill\BillStatus;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      schema="BillSetStatusRequest",
 *
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
            'status' => [
                'required',
                new EnumValue(BillStatus::class),
            ],
        ];
    }
}
