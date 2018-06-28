<?php

namespace App\Mail\Classroom;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Services\Mail\Headers;
use App\Classroom\Models\Guest;
use App\Classroom\Models\Timetable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class GuestRegistrationConfirmation extends Mailable implements ShouldQueue
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
     * @param Guest     $user
     * @param Timetable $timetable
     */
    public function __construct(Guest $user, Timetable $timetable)
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
        return $this->addHeaders()
                    ->subject('Total People Course Registration Confirmation')
                    ->view('emails.classroom.registration-confirmation-guest');
    }
}
