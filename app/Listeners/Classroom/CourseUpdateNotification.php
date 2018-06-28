<?php

namespace App\Listeners\Classroom;

use Mail;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\Classroom\CourseWasUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\Classroom\ScheduledCourseWasUpdated;

class CourseUpdateNotification implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ScheduledCourseWasUpdated $event
     * @return void
     */
    public function handle(ScheduledCourseWasUpdated $event)
    {
        $timetable = $event->getTimetable();

        $event->getTimetable()->users->each(function ($user) use ($timetable) {
            Mail::to($user->email)->cc($user->getManagers()->pluck('email')->all())
                ->send(new CourseWasUpdated($user, $timetable));
        });

        $event->getTimetable()->guests->each(function ($user) use ($timetable) {
            Mail::to($user->email)->send(new CourseWasUpdated($user, $timetable));
        });
    }
}
