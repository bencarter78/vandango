<?php

namespace App\Http\Requests\RoomMate;

use Illuminate\Foundation\Http\FormRequest;

class RoomRequest extends FormRequest
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
            'site_id' => 'required',
            'capacity' => 'required',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'site_id.required' => 'Please select the site where the room is.',
        ];
    }
}
