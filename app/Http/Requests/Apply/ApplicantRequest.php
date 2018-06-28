<?php

namespace App\Http\Requests\Apply;

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
            'first_name' => 'required',
            'surname' => 'required',
            'email' => 'nullable|email',
            'dob' => 'date_format:d/m/Y',
            'starting_on' => 'required',
            'sector_id' => 'required',
            'qualification_plan_id' => 'required',
            'programme_type' => 'required'
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
            'dob.required' => 'Please enter the date of birth of the learner.',
            'dob.date_format' => 'Please enter the date of birth in the format DD/MM/YYYY (e.g. 25/12/2001).',
            'starting_on.required' => 'Please enter the proposed start date.',
            'sector_id.required' => 'Please select the sector.',
            'qualification_plan_id.required' => 'Please select the qualification plan.',
            'programme_type.required' => 'Please select the programme type.',
        ];
    }
}
