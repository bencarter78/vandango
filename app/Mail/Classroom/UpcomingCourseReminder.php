<?php

namespace App\Mail\Classroom;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Classroom\Models\User;
use App\Services\Mail\Headers;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpcomingCourseReminder extends Mailable
{
    use Queueable, SerializesModels, Headers;

    /**
     * @var
     */
    public $user;

    /**
     * @var
     */
    public $timetable;

    /**
     * @var array
     */
    private $headers = ['X-MAILGUN-TAG' => 'classroom'];

    /**
     * Create a new message instance.
     *
     * @param $user
     * @param $timetable
     */
    public function __construct($user, $timetable)
    {
        $this->user = $user;
        $this->timetable = $timetable;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->addHeaders()->subject('Your Upcoming Course Reminder');

        if ($this->user instanceof User) {
            return $this->view('emails.classroom.upcoming-course-reminder-user');
        }

        return $this->view('emails.classroom.upcoming-course-reminder-guest');
    }
}
