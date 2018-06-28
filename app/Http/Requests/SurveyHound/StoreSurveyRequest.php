<?php

namespace App\Http\Requests\SurveyHound;

use App\Http\Requests\Request;

class StoreSurveyRequest extends Request
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
            'subject' => 'required',
            'message' => 'required',
            'sql' => 'required',
        ];
    }
}
