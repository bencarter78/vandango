<?php

namespace App\Mail\Blink;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EnquiryAssignment extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var
     */
    public $enquiry;

    /**
     * @var
     */
    public $user;

    /**
     * Create a new message instance.
     *
     * @param $enquiry
     * @param $user
     */
    public function __construct($enquiry, $user)
    {
        $this->enquiry = $enquiry;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Enquiry has been assigned to you')
                    ->view('emails.blink.enquiry-assignment');
    }
}
