<?php

namespace App\Http\Requests\UserManager;

use App\Http\Requests\Request;

class StoreDepartmentRequest extends Request
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
            'department' => 'required',
            'manager_id' => 'required',
            'ad_id' => 'required',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'department.required' => 'Please provide a name for the department',
            'manager_id.required' => 'Please link a line manager with this department',
            'ad_id.required' => 'Please link an Associate Director with this department',
        ];
    }

}
