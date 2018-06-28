<?php

namespace App\Http\Requests\Cpd;

use Illuminate\Foundation\Http\FormRequest;

class ActivityRequest extends FormRequest
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
            'user_id' => 'required',
            'title' => 'required',
            'starts_on' => 'required|date_format:d/m/Y',
            'ends_on' => 'required|date_format:d/m/Y',
            'completed_on' => 'nullable|date_format:d/m/Y',
            'total_hours' => 'nullable|integer|required_with:completed_on',
            'grade_id' => 'nullable|required_with:completed_on',
            'reflection' => 'nullable|required_with:completed_on',
            'organisation' => 'required',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'Please enter the title of the activity',
            'starts_on.required' => 'Please enter the start date',
            'ends_on.required' => 'Please enter the end date',
            'total_hours.integer' => 'Please enter a whole number only',
            'total_hours.required_with' => 'Please enter the number of CPD hours',
            'organisation.required' => 'Please enter the name of the delivery organisation',
            'grade_id.required_with' => 'Please grade this activity',
            'reflection.required_with' => 'Please reflect on this activity',
        ];
    }
}
