<?php

namespace App\Mail\Blink;

use App\Apply\Models\Applicant;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ApplicantWasAdded extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Applicant
     */
    public $applicant;

    /**
     * Create a new message instance.
     *
     * @param Applicant $applicant
     */
    public function __construct(Applicant $applicant)
    {
        $this->applicant = $applicant;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.blink.applicant-added')
                    ->subject('New Applicant Added To Enquiry');
    }
}
