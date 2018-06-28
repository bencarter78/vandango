<?php

namespace App\Events\Classroom;

use Illuminate\Queue\SerializesModels;

class UserWasRemovedFromScheduledCourse
{
    use SerializesModels;

    /**
     * @var
     */
    private $attendee;

    /**
     * @var
     */
    private $timetable;

    /**
     * Create a new event instance.
     *
     * @param $attendee
     * @param $timetable
     */
    public function __construct($attendee, $timetable)
    {
        $this->attendee = $attendee;
        $this->timetable = $timetable;
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
    public function getTimetable()
    {
        return $this->timetable;
    }
}
