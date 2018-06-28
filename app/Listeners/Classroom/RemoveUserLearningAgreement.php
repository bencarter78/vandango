<?php

namespace App\Listeners\Classroom;

use App\Classroom\Models\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\Classroom\UserWasRemovedFromScheduledCourse;

class RemoveUserLearningAgreement implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     *
     * @param  UserWasRemovedFromScheduledCourse $event
     * @return void
     */
    public function handle(UserWasRemovedFromScheduledCourse $event)
    {
        if ($event->getAttendee() instanceof User) {
            if ($this->learningAgreementRequired($event)) {
                $this->deleteUserLearningAgreement($event);
            }
        }
    }

    /**
     * @param UserWasRemovedFromScheduledCourse $event
     * @return mixed
     */
    private function learningAgreementRequired(UserWasRemovedFromScheduledCourse $event)
    {
        return $event->getTimetable()->course->is_agreement_required;
    }

    /**
     * @param UserWasRemovedFromScheduledCourse $event
     */
    private function deleteUserLearningAgreement(UserWasRemovedFromScheduledCourse $event)
    {
        $event->getAttendee()->agreements->where('timetable_id', $event->getTimetable()->id)->first()->forceDelete();
    }
}
