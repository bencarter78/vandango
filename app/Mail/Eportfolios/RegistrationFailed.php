<?php

namespace App\Mail\Eportfolios;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Apply\Models\Applicant;
use Illuminate\Queue\SerializesModels;

class RegistrationFailed extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var Applicant
     */
    public $applicant;

    /**
     * @var
     */
    public $exception;

    /**
     * Create a new message instance.
     *
     * @param Applicant $applicant
     * @param           $exception
     */
    public function __construct(Applicant $applicant, $exception)
    {
        $this->applicant = $applicant;
        $this->exception = $exception;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("ePortfolio Registration Failed for {$this->applicant->name} ({$this->applicant->sector->title}")
                    ->view('emails.eportfolios.registration-failed');
    }
}
