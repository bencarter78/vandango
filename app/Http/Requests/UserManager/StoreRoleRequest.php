<?php

namespace App\Http\Requests\UserManager;

use App\Http\Requests\Request;

class StoreRoleRequest extends Request
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
            'job_role' => 'required',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'job_role.required' => 'Please provide a name for the job_role',
        ];
    }

}
