<?php

namespace App\Mail\Classroom;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Services\Mail\Headers;
use App\Classroom\Models\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RemovedFromCourse extends Mailable
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
        $this->addHeaders()->subject('Total People Course Update');

        if ($this->user instanceof User) {
            return $this->view('emails.classroom.deregistration-confirmation');
        }

        return $this->view('emails.classroom.deregistration-confirmation-guest');
    }
}
