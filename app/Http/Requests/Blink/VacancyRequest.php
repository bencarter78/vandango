<?php

namespace App\Http\Requests\Blink;

use Illuminate\Foundation\Http\FormRequest;

class VacancyRequest extends FormRequest
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
        if ( ! $this->has('submit')) {
            return [
                'contact_id' => 'required',
                'wage' => 'nullable|numeric',
                'hours' => 'nullable|numeric',
                'positions_count' => 'nullable|integer',
                'duration' => 'nullable|integer',
                'closes_on' => 'nullable|date_format:d/m/Y',
                'interviews_on' => 'nullable|date_format:d/m/Y',
                'starts_on' => 'nullable|date_format:d/m/Y',
            ];
        }

        return [
            'enquiry_id' => 'required',
            'contact_id' => 'required',
            'location_id' => 'required',
            'organisation_description' => 'required',
            'title' => 'required',
            'description' => 'required',
            'wage' => 'required|numeric',
            'hours' => 'required|numeric',
            'working_week' => 'required',
            'positions_count' => 'required|integer',
            'sector_id' => 'required',
            'framework_id' => 'required',
            'qual_type' => 'required',
            'level_id' => 'required',
            'duration' => 'required|integer',
            'closes_on' => 'required|date_format:d/m/Y',
            'interviews_on' => 'required|date_format:d/m/Y',
            'starts_on' => 'required|date_format:d/m/Y',
            'required_skills' => 'required',
            'required_qualifications' => 'required',
            'personal_qualities' => 'required',
            'training_provided' => 'required',
            'future_prospects' => 'required',
            'considerations' => 'required',
            'question_1' => 'required',
            'question_2' => 'required',
            'is_visible' => 'required',
            'application_route_url' => 'nullable|url',
            'filter_applications' => 'required',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'contact_id.required' => 'Please select an organisation contact',
            'location_id.required' => 'Please select an organisation location',
            'organisation_description.required' => 'Please enter a description of the company',
            'title.required' => 'Please enter the job title of the vacancy',
            'description.required' => 'Please enter a description of the vacancy',
            'wage.required' => 'Please enter the wage for this vacancy',
            'wage.numeric' => 'Please enter a number only (whole or decimal), remove any characters such as £',
            'hours.required' => 'Please enter the total number of hours per week',
            'hours.numeric' => 'Please enter a number only, remove any characters/letters',
            'working_week.required' => 'Please enter a description of the working week',
            'positions_count.required' => 'Please enter how many positions are available',
            'positions_count.numeric' => 'Please enter a number only, remove any characters/letters',
            'sector_id.required' => 'Please select a sector',
            'framework_id.required' => 'Please select a framework',
            'qual_type.required' => 'Please select the type of qualification',
            'level.required' => 'Please select the level of this apprenticeship',
            'duration.required' => 'Please enter the duration of the apprenticeship',
            'closes_on.required' => 'Please enter a closing date',
            'interviews_on.required' => 'Please enter an approximate interview date',
            'starts_on.required' => 'Please enter an approximate start date',
            'closes_on.date_format' => 'Please use the date format DD/MM/YYYY',
            'interviews_on.date_format' => 'Please use the date format DD/MM/YYYY',
            'starts_on.date_format' => 'Please use the date format DD/MM/YYYY',
            'required_skills.required' => 'Please enter a description of the required skills',
            'required_qualifications.required' => 'Please enter a description of the required qualifications',
            'personal_qualities.required' => 'Please enter a description of the personal qualities',
            'training_provided.required' => 'Please enter a description of the training provided',
            'future_prospects.required' => 'Please enter a description of the future prospects',
            'considerations.required' => 'Please enter a description of the considerations',
            'question_1.required' => 'Please enter a question',
            'question_2.required' => 'Please enter a question',
            'is_visible.required' => 'Please select the organisations visibility',
            'application_route_url.url' => 'Please enter a valid url',
            'filter_applications.required' => 'Please select if applications should be filtered',
        ];
    }
}
