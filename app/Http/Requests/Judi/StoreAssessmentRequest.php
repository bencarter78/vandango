<?php namespace App\Http\Requests\Judi;

use App\Http\Requests\Request;

class StoreAssessmentRequest extends Request
{
    /**
     * @var array
     */
    protected $rules = [
        'create' => [
            'user_id' => 'required',
            'sector_id' => 'required',
            'assessor_id' => 'required',
            'assessment_date' => 'required|date_format:d/m/Y|size:10',
            'process_id' => 'required',
        ],
        'update' => [
            'assessor_id' => 'required',
            'assessment_date' => 'required|date_format:d/m/Y|size:10',
        ],
        'destroy' => [
            'cancellation_id' => 'required',
        ],
    ];

    /**
     * @var array
     */
    protected $messages = [
        'create' => [
            'user_id.required' => 'Please provide set the staff member to be assessed.',
            'sector_id.required' => 'Please select a sector for this assessment',
            'assessor_id.required' => 'Please provide the assessor\'s name.',
            'process_id.required' => 'Please provide the process for the user to be assessed against',
            'assessment_date.required' => 'Please enter an assessment date.',
            'assessment_date.date_format' => 'Sorry the format does not match the required format of DD/MM/YYYY',
        ],
        'update' => [
            'assessor_id.required' => 'Please provide the assessor\'s name.',
            'assessment_date.required' => 'Please enter an assessment date.',
            'assessment_date.date_format' => 'Sorry the format does not match the required format of DD/MM/YYYY',
        ],
        'destroy' => [
            'cancellation_id.required' => 'Please give a reason why you are deleting this assessment.',
        ],
    ];

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
        if (isset($this->rules[$this->request->get('ruleset')])) {
            return $this->rules[$this->request->get('ruleset')];
        }

        return [];
    }

    /**
     * @return array
     */
    public function messages()
    {
        if (isset($this->messages[$this->request->get('ruleset')])) {
            return $this->messages[$this->request->get('ruleset')];
        }

        return [];
    }

}
