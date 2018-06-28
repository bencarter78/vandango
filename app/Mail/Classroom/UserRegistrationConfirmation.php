<?php

namespace App\Mail\Classroom;

use Storage;
use Illuminate\Mail\Mailable;
use Illuminate\Bus\Queueable;
use App\Services\Mail\Headers;
use App\Classroom\Models\User;
use Eluceo\iCal\Component\Event;
use Eluceo\iCal\Component\Calendar;
use App\Classroom\Models\Timetable;
use Illuminate\Queue\SerializesModels;

class UserRegistrationConfirmation extends Mailable
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
     * @var
     */
    private $ical;

    /**
     * @var array
     */
    private $headers = [];

    /**
     * Create a new message instance.
     *
     * @param User      $user
     * @param Timetable $timetable
     */
    public function __construct(User $user, Timetable $timetable)
    {
        $this->user = $user;
        $this->timetable = $timetable;
        $this->headers['X-Mailgun-Tag'] = 'classroom_timetable_' . $timetable->id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->setICal();

        return $this->addHeaders()
                    ->subject('Total People Course Registration Confirmation')
                    ->view('emails.classroom.registration-confirmation')
                    ->attach(storage_path('app/' . $this->getIcal()));
    }

    /**
     * @return mixed
     */
    public function getIcal()
    {
        return $this->ical;
    }

    /**
     * @return void
     */
    public function setIcal()
    {
        $vCalendar = new Calendar('vandango.dev');
        $vCalendar->addComponent(
            (new Event())->setDtStart(new \DateTime($this->timetable->starts_at))
                         ->setDtEnd(new \DateTime($this->timetable->ends_at))
                         ->setNoTime(true)
                         ->setSummary($this->timetable->course->name)
        );

        $file = 'classroom/' . str_slug($this->timetable->course->name . '_' . $this->timetable->starts_at->format('Ymd')) . '.ics';
        Storage::put($file, $vCalendar->render());

        $this->ical = $file;
    }
}
