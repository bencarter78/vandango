<?php

namespace App\Http\Requests\Judi;

use App\Http\Requests\Request;

class StoreProcessRequest extends Request
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
            'trigger_week' => 'required',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'You need to provide a name for the process',
            'trigger_week.required' => 'You need to provide a trigger point for the process',
        ];
    }

}
