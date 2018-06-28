<?php

namespace App\Listeners\Classroom;

use Mail;
use App\Classroom\Models\User;
use App\Mail\Classroom\CourseAbsentee;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\Classroom\UserWasAbsentFromCourse;

class UserAbsentFromCourseNotification implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     *
     * @param  UserWasAbsentFromCourse $event
     * @return void
     */
    public function handle(UserWasAbsentFromCourse $event)
    {
        $user = $event->getAttendee();

        if ($user instanceof User) {
            return Mail::to($user->email)
                       ->cc($user->getManagers()->pluck('email')->all())
                       ->send(new CourseAbsentee($event->getAttendee(), $event->getTimetable()));
        }
    }
}
