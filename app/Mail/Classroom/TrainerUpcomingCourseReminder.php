<?php

namespace App\Mail\Classroom;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Services\Mail\Headers;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TrainerUpcomingCourseReminder extends Mailable
{
    use Queueable, SerializesModels, Headers;

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
     * @param $timetable
     */
    public function __construct($timetable)
    {
        $this->timetable = $timetable;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->addHeaders()
                    ->subject('Upcoming Course Register')
                    ->view('emails.classroom.upcoming-course-reminder-trainer');
    }
}
