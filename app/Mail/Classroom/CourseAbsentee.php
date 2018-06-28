<?php

namespace App\Mail\Classroom;

use Illuminate\Mail\Mailable;
use Illuminate\Bus\Queueable;
use App\Classroom\Models\User;
use App\Services\Mail\Headers;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CourseAbsentee extends Mailable
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
        if ($this->user instanceof User) {
            return $this->addHeaders()
                        ->subject('Total People Course Absence')
                        ->view('emails.classroom.course-absentee');
        }
    }
}
