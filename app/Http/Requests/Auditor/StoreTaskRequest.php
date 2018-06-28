<?php namespace App\Http\Requests\Auditor;

use App\Http\Requests\Request;

class StoreTaskRequest extends Request
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
        $rules = [
            'category_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'sql' => 'required',
            'recipients' => 'required',
            'notification' => 'required',
        ];

        if ($this->has('reply_to')) {
            $rules['reply_to'] = 'sometimes|email';
        }

        return $rules;
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'category_id.required' => 'Please select a category for this task',
            'title.required' => 'Please provide a title for this task',
            'description.required' => 'Please provide a description about this task',
            'sql.required' => 'Please enter the SQL for this task',
            'recipients.required' => 'Please indicate who the recipients are for this task',
            'notification.required' => 'Please provide the text to be sent to the notifiers',
        ];
    }

}
