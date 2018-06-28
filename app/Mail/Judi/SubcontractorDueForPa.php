<?php

namespace App\Mail\Judi;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubcontractorDueForPa extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var
     */
    public $subcontractors;

    /**
     * Create a new message instance.
     *
     * @param $subcontractors
     */
    public function __construct($subcontractors)
    {
        $this->subcontractors = $subcontractors;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Subcontractors Performance Assessment Due')
                    ->view('judi.emails.subcontractor-has-pa-due');
    }
}
