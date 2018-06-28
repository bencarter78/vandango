<?php

namespace App\Listeners\Classroom;

use Mail;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\Classroom\RemovedFromCourse;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\Classroom\UserWasRemovedFromScheduledCourse;

class SendUnregisteredConfirmationNotification implements ShouldQueue
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
        Mail::to($event->getAttendee()->email)
            ->send(new RemovedFromCourse($event->getAttendee(), $event->getTimetable()));
    }
}
