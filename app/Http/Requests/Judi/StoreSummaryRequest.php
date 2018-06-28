<?php

namespace App\Http\Requests\Judi;

use App\Http\Requests\Request;

class StoreSummaryRequest extends Request
{
    /**
     * @var int
     */
    private $insufficientGradeId = 11;

    /**
     * @var array
     */
    private $healthAndSafetyReportIds = [23, 24, 25];

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
        $rules = [];
        $rules['grade_id'] = 'required';

        if ($this->summaryIsBeingSubmitted()) {
            $rules['assessment_date'] = 'required|date_format:d/m/Y|size:10';

            if ($this->summaryIsHealthAndSafety()) {
                $rules['document_path'] = 'required_without:uploaded_document';
            } elseif ( ! $this->summaryHasInsufficientEvidence()) {
                $rules['document_path'] = 'required_without:uploaded_document';
            }
        }

        return $rules;
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'grade_id.required' => 'Please enter an overall grade for this report.',
            'assessment_date.required' => 'Please enter an assessment date.',
            'assessment_date.date_format' => 'Sorry the format does not match the required format of DD/MM/YYYY',
            'document_path.required' => 'Please upload the linked documents for this summary',
        ];
    }

    /**
     * @return bool
     */
    private function summaryIsBeingSubmitted()
    {
        return $this->has('submit');
    }

    /**
     * @return bool
     */
    private function summaryHasInsufficientEvidence()
    {
        return $this->has('grade_id') && $this->get('grade_id') == $this->insufficientGradeId;
    }

    /**
     * @return bool
     */
    private function summaryIsHealthAndSafety()
    {
        return in_array($this->get('report_id'), $this->healthAndSafetyReportIds);
    }
}
