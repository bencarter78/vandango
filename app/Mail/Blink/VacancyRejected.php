<?php

namespace App\Mail\Blink;

use Illuminate\Mail\Mailable;

class VacancyRejected extends Mailable
{
    /**
     * @var
     */
    public $vacancy;

    /**
     * Create a new message instance.
     *
     * @param $vacancy
     */
    public function __construct($vacancy)
    {
        $this->vacancy = $vacancy;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Vacancy with {$this->vacancy->contact->organisation->name} was rejected")
                    ->view('emails.blink.vacancy-rejected');
    }
}
