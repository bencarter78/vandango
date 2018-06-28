<?php

namespace App\Http\Requests\Classroom;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class TimeTableRequest extends FormRequest
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
        list($startsAt, $endsAt) = $this->getStartEndDateTimes();

        $this->merge([
            'starts_at' => $startsAt,
            'ends_at' => $endsAt,
        ]);

        return [
            'course_id' => 'required',
            'user_id' => 'required',
            'room_id' => 'required',
            'start_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ];
    }

    /**
     * @return array
     */
    private function getStartEndDateTimes()
    {
        $startDate = $this->request->get('start_date') == '' ? date('d/m/Y') : $this->request->get('start_date');
        $startTime = $this->request->get('start_time') ?: '00:00';
        $endTime = $this->request->get('end_time') ?: '00:00';
        $end = $this->request->get('end_date') == '' ? $startDate : $this->request->get('end_date');

        $startsAt = Carbon::createFromFormat('d/m/Y H:i', $startDate . ' ' . $startTime);
        $endsAt = Carbon::createFromFormat('d/m/Y H:i', $end . ' ' . $endTime);

        return [$startsAt, $endsAt];
    }
}
