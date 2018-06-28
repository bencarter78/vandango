<?php

namespace App\Http\Requests\Blink;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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
            'title' => 'required',
            'sector_id' => 'required',
            'type' => 'required',
            'framework_expires_on' => 'required_if:type,Framework|nullable|date_format:d/m/Y',
            'code' => 'required',
            'description' => 'required',
            'level' => 'required',
            'capability' => 'required',
            'awarding_body_id' => 'required',
            'epa_provider' => 'required',
            'aim_ref_standard' => 'required',
            'aim_ref_mandatory' => 'required',
            'aim_ref_optional' => 'required',
            'programme_length' => 'required',
            'programme_length_adult' => 'required',
            'total_training' => 'required',
            'total_epa' => 'required',
            'total_negotiated' => 'required',
            'funding_band' => 'required',
            'funding_cap' => 'required',
            'co_investment' => 'required',
            'employer_contribution' => 'required',
            'additional_delivery' => 'required',
            'total_contribution' => 'required',
            'provider_incentive' => 'required',
            'provider_uplift' => 'required',
        ];
    }
}
