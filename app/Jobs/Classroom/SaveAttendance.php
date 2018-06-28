<?php

namespace App\Jobs\Classroom;

use Carbon\Carbon;
use App\Classroom\Repositories\Timetable;
use App\Events\Classroom\UserAttendedCourse;
use App\Events\Classroom\UserWasAbsentFromCourse;

class SaveAttendance
{
    /**
     * @var
     */
    private $course;

    /**
     * @var array
     */
    private $data;

    /**
     * Create a new job instance.
     *
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @param Timetable $timetable
     * @return void
     */
    public function handle(Timetable $timetable)
    {
        $this->setCourse($timetable->requireById($this->data['timetableId']));

        $this->updateAttendance();

        if ($this->userAttended()) {
            return event(new UserAttendedCourse($this->getAttendee(), $this->getCourse()));
        }

        return event(new UserWasAbsentFromCourse($this->getAttendee(), $this->getCourse()));
    }

    /**
     * @return mixed
     */
    private function getAttendee()
    {
        return $this->getCourse()
                    ->{$this->data['type']}()
                    ->where($this->data['type'] . '.id', $this->data['userId'])
                    ->first();
    }

    /**
     * @return void
     */
    private function updateAttendance()
    {
        $this->getCourse()->{$this->data['type']}()->updateExistingPivot($this->data['userId'], [
            'attended' => $this->data['attended'],
            'deleted_at' => Carbon::now(),
        ]);
    }

    /**
     * @return bool
     */
    private function userAttended()
    {
        return $this->data['attended'] == true;
    }

    /**
     * @return mixed
     */
    public function getCourse()
    {
        return $this->course;
    }

    /**
     * @param mixed $course
     */
    public function setCourse($course)
    {
        $this->course = $course;
    }
}
