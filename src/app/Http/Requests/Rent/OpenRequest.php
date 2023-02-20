<?php

namespace App\Http\Requests\Rent;

use App\Models\Renter;
use App\Models\Vehicle;
use Illuminate\Foundation\Http\FormRequest;

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
    public function rules()
    {
        return [
            'renter' => [
                'required',
                'integer',
                'numeric',
                'exists:renters,id',
                'bail',
                function ($attribute, $value, $fail) {
                    $badRenterStatuses = array(
                        'frozen',
                        'blocked',
                    );

                    $renterStatus = Renter::find($value)->status;

                    if (in_array($renterStatus, $badRenterStatuses)) {
                        $fail("Renter with id '$value' has '$renterStatus' status");
                    }
                }
            ],
            'vehicle' => [
                'required',
                'integer',
                'numeric',
                'exists:vehicles,id',
                'bail',
                function ($attribute, $value, $fail) {
                    if (Vehicle::find($value)->status != 'expectation') {
                        $fail("Vehicle with id '$value' can not be rented");
                    }
                }
            ]
        ];
    }
}
