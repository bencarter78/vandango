<?php

namespace App\Mail\Blink;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class VacancyApprovalRequired extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var
     */
    public $vacancy;

    /**
     * @var
     */
    public $user;

    /**
     * Create a new message instance.
     *
     * @param $vacancy
     * @param $user
     */
    public function __construct($vacancy, $user)
    {
        $this->vacancy = $vacancy;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Vacancy Submitted, Approval Required')
                    ->view('emails.blink.vacancy-approval-required');
    }
}
