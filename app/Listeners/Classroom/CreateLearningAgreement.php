<?php

namespace App\Listeners\Classroom;

use App\Classroom\Models\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Classroom\Models\LearningAgreement;
use App\Events\Classroom\UserWasAddedToScheduledCourse;

class CreateLearningAgreement implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * @var LearningAgreement
     */
    private $model;

    /**
     * Create the event listener.
     *
     * @param LearningAgreement $model
     */
    public function __construct(LearningAgreement $model)
    {
        $this->model = $model;
    }

    /**
     * Handle the event.
     *
     * @param  UserWasAddedToScheduledCourse $event
     * @return void
     */
    public function handle(UserWasAddedToScheduledCourse $event)
    {
        if ($this->attendeeRequiresLearningAgreement($event)) {
            $this->model->create([
                'user_id' => $event->getAttendee()->id,
                'timetable_id' => $event->getTimetable()->id,
            ]);
        }
    }

    /**
     * @param UserWasAddedToScheduledCourse $event
     * @return bool
     */
    private function attendeeRequiresLearningAgreement(UserWasAddedToScheduledCourse $event)
    {
        return $event->getAttendee() instanceof User && $event->getTimetable()->course->is_agreement_required;
    }
}
