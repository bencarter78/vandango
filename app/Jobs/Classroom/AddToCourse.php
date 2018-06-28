<?php

namespace App\Jobs\Classroom;

use App\Classroom\Models\Timetable;
use App\Events\Classroom\UserWasAddedToScheduledCourse;

class AddToCourse
{
    /**
     * @var
     */
    private $user;

    /**
     * @var Timetable
     */
    private $timetable;

    /**
     * @var
     */
    private $userType;

    /**
     * @var
     */
    private $authUser;

    /**
     * Create a new job instance.
     *
     * @param           $user
     * @param Timetable $timetable
     * @param           $userType
     * @param           $authUser
     */
    public function __construct($user, Timetable $timetable, $userType, $authUser)
    {
        $this->user = $user;
        $this->timetable = $timetable;
        $this->userType = $userType;
        $this->authUser = $authUser;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->courseIsAtCapacity()) {
            return [
                'title' => 'Course capacity exceeded',
                'detail' => 'Unable to add attendee, course is at capacity.',
            ];
        }

        if ($this->userIsRegisteredForCourse()) {
            return [
                'title' => 'User exists',
                'detail' => 'Attendee already attached to this scheduled course.',
            ];
        }

        if ( ! $this->userCanAddAttendeeToRegister()) {
            return [
                'title' => 'Unauthorized',
                'detail' => 'You do not have permission to add this person to the course. Are you their manager?',
            ];
        }

        $this->register();
    }

    /**
     * @return bool
     */
    private function courseIsAtCapacity()
    {
        return $this->timetable->cohortSize() >= $this->timetable->venue->capacity;
    }

    /**
     * @return bool
     */
    private function userIsRegisteredForCourse()
    {
        return in_array($this->user->id, $this->timetable->{$this->userType}->pluck('id')->all());
    }

    /**
     * @return bool
     */
    private function userCanAddAttendeeToRegister()
    {
        return $this->authUser->hasAccess('classroomAdmin') || $this->authUser->isManagerOf($this->user);
    }

    /**
     * @return void
     */
    private function register()
    {
        $this->timetable->{$this->userType}()->attach($this->user->id, ['cost' => $this->timetable->course->cost]);

        event(new UserWasAddedToScheduledCourse($this->user, $this->timetable));
    }
}
