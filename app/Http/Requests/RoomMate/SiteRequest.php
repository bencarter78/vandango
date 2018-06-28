<?php

namespace App\Http\Requests\RoomMate;

use Illuminate\Foundation\Http\FormRequest;

class SiteRequest extends FormRequest
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
            'name' => 'required',
            'add1' => 'required',
            'town' => 'required',
            'county' => 'required',
            'postcode' => 'required',
            'is_owned' => 'required',
            'has_disabled_access' => 'required',
            'opens_at' => 'required',
            'closes_at' => 'required',
        ];
    }
}
