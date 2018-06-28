<?php

namespace App\Listeners\Classroom;

use Mail;
use App\Classroom\Models\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\Classroom\UserRegistrationConfirmation;
use App\Mail\Classroom\GuestRegistrationConfirmation;
use App\Events\Classroom\UserWasAddedToScheduledCourse;

class SendRegistrationConfirmationNotification implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     *
     * @param  UserWasAddedToScheduledCourse $event
     * @return void
     */
    public function handle(UserWasAddedToScheduledCourse $event)
    {
        $mailer = $event->getAttendee() instanceof User
            ? new UserRegistrationConfirmation($event->getAttendee(), $event->getTimetable())
            : new GuestRegistrationConfirmation($event->getAttendee(), $event->getTimetable());

        Mail::to($event->getAttendee()->email)->send($mailer);
    }
}
