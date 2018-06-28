<?php

namespace App\Events\Classroom;

use App\Classroom\Models\Timetable;
use Illuminate\Queue\SerializesModels;

class UserWasAddedToScheduledCourse
{
    use SerializesModels;

    /**
     * @var
     */
    private $attendee;

    /**
     * @var Timetable
     */
    private $timetable;

    /**
     * Create a new event instance.
     *
     * @param           $attendee
     * @param Timetable $timetable
     */
    public function __construct($attendee, Timetable $timetable)
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
     * @return Timetable
     */
    public function getTimetable()
    {
        return $this->timetable;
    }
}
