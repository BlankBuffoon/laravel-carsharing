<?php

namespace App\Http\Requests\Rent;

use App\Models\Rent;
use Illuminate\Foundation\Http\FormRequest;

class CloseRequest extends FormRequest
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
            'id' => [
                'required',
                'integer',
                'numeric',
                'exists:rents,id',
                'bail',
                function ($attribute, $value, $fail) {
                    $rent = Rent::find($value);
                    if ($rent->status != 'open') {
                        $fail("Rent status in not open");
                    }
                    if ($rent->vehicle->status != 'rented') {
                        $fail("Vehicle status in not rented");
                    }
                }
            ]
        ];
    }
}
