<?php

namespace App\Mail\Apply;

use Illuminate\Mail\Mailable;
use Illuminate\Bus\Queueable;
use App\Apply\Models\Applicant;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ApplicantAssignedToAdviser extends Mailable implements ShouldQueue
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
        return $this->view('emails.apply.applicants.adviser-assigned');
    }
}
