<?php

namespace App\Mail\Apply;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UnmatchedApplicants extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var
     */
    public $applicants;

    /**
     * Create a new message instance.
     *
     * @param $applicants
     */
    public function __construct($applicants)
    {
        $this->applicants = $applicants;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.apply.applicants.unmatched')->subject('Unmatched PICS Applicants');
    }
}
