<?php

namespace App\Http\Requests\UserManager;

use App\Http\Requests\Request;

class StoreSectorRequest extends Request
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
            'code' => 'required',
            'name' => 'required',
            'department_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please provide a name for the sector',
            'code.required' => 'Please provide a code for the sector',
            'department_id.required' => 'Please link a department to this sector',
        ];
    }

}
