<?php

namespace App\Http\Requests\UserManager;

use App\Http\Requests\Request;

class RegisterUserRequest extends Request
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
            'first_name' => 'alpha_dash|required',
            'surname' => 'alpha_dash|required',
            'email' => 'email|required|unique:users',
            'start_date' => 'required|date_format:d/m/Y|size:10',
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'Please provide a valid first name',
            'last_name.required' => 'Please provide a valid surname',
            'email.required' => 'Please provide a valid email address',
            'email.unique' => 'Sorry, that email address has already been registered',
            'start_date.required' => 'Please enter a start date for the user.',
            'start_date.date_format' => 'Sorry the format does not match the required format of DD/MM/YYYY',
        ];
    }

}
