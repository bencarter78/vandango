<?php

namespace App\Http\Requests\Blink;

use App\Http\Requests\Request;

class ApplicantRequest extends Request
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
            'enquiry_id' => 'required',
            'user_id' => 'required',
            'first_name' => 'required',
            'surname' => 'required',
            'dob' => 'required|date_format:d/m/Y',
            'email' => 'nullable|email',
            'starting_on' => 'required|date_format:d/m/Y',
            'sector_id' => 'required',
            'qualification_plan_id' => 'required',
            'programme_type' => 'required',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'first_name.required' => 'Please enter the first name of the learner.',
            'surname.required' => 'Please enter the surname of the learner.',
            'email.required' => 'Please enter the email of the learner.',
            'starting_on.required' => 'Please enter the proposed start date.',
            'sector_id.required' => 'Please select the sector.',
            'programme_type.required' => 'Please select the programme type.',
        ];
    }
}
