<?php

namespace App\Http\Requests\Blink;

use App\Blink\Models\Status;
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
            'due_at' => 'required|date_format:d/m/Y',
            'note' => 'required',
            'status_id' => 'required',
            'conclusion_id' => 'required_if:status_id,' . $this->getClosedStatus(),
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'due_on.required' => 'Please enter the date this activity took place',
            'due_on.date_format' => 'Please enter the date in the format DD/MM/YYYY',
            'note.required' => 'Please give a description of the activity',
            'status_id.required' => 'Please select a status for the enquiry',
            'conclusion_id.required_if' => 'Please select a reason for the enquiry closing',
        ];
    }

    /**
     * @return mixed
     */
    public function getClosedStatus()
    {
        return Status::whereName(config('vandango.blink.statuses.completed'))->first()->id;
    }
}
