<?php

namespace App\Http\Requests\Locations;

use Illuminate\Foundation\Http\FormRequest;

class LocationRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'add1' => 'required',
            'town' => 'required',
            'postcode' => 'required',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'add1.required' => 'Please enter the first line of the address',
            'town.required' => 'Please enter the town',
            'postcode.required' => 'Please enter the post code',
        ];
    }
}
