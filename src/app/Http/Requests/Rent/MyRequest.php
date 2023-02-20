<?php

namespace App\Http\Requests\Rent;

use Illuminate\Foundation\Http\FormRequest;

class MyRequest extends FormRequest
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
            'asd' => [
                'required',
                'integer',
                'numeric',
                function ($attribute, $value, $fail) {
                    if ($value !== 123) {
                        $fail("asd must be 123 dolboeb!");
                    }
                }
            ],
            'dsa' => 'required|integer'
        ];
    }
}
