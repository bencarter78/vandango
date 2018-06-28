<?php

namespace App\Events\Classroom;

use App\Classroom\Models\Timetable;
use Illuminate\Queue\SerializesModels;

class ScheduledCourseWasUpdated
{
    use SerializesModels;

    /**
     * @var Timetable
     */
    private $timetable;

    /**
     * Create a new event instance.
     *
     * @param Timetable $timetable
     */
    public function __construct(Timetable $timetable)
    {
        $this->timetable = $timetable;
        \Log::info('event fired');
    }

    /**
     * @return Timetable
     */
    public function getTimetable()
    {
        return $this->timetable;
    }
}
