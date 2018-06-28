<?php

namespace App\Http\Requests\Classroom;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        $data = [
            'name' => 'required',
            'name' => Rule::unique('classroom_courses')->ignore($this->request->get('id')),
            'course_type_id' => 'required',
            'is_mandatory' => 'required',
            'is_agreement_required' => 'required',
            'cost' => 'numeric|between:0,99999.99',
            'description' => 'required',
        ];

        if ($this->has('url')) {
            $data['resource_url'] = 'url';
        }

        return $data;
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Please enter a name for this course',
            'name.unique' => 'A course with this name already exists.',
            'description.required' => 'Please enter a description for this course',
            'is_mandatory.required' => 'Please indicate if the course is mandatory',
            'is_agreement_required.required' => 'Please indicate if a learning agreement is required',
        ];
    }
}
