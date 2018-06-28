<?php

namespace App\Events\Classroom;

use App\Classroom\Models\Timetable;
use Illuminate\Queue\SerializesModels;

class UserAttendedCourse
{
    use SerializesModels;

    /**
     * @var
     */
    private $attendee;

    /**
     * @var
     */
    private $course;

    /**
     * Create a new event instance.
     *
     * @param $attendee
     * @param $course
     */
    public function __construct($attendee, Timetable $course)
    {
        $this->attendee = $attendee;
        $this->course = $course;
    }

    /**
     * @return mixed
     */
    public function getAttendee()
    {
        return $this->attendee;
    }

    /**
     * @return mixed
     */
    public function getCourse()
    {
        return $this->course;
    }
}
