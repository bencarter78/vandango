<?php

namespace App\Mail\Blink;

use App\Blink\Models\Enquiry;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EnquiryActivity extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Enquiry
     */
    public $enquiry;

    /**
     * Create a new message instance.
     *
     * @param Enquiry $enquiry
     */
    public function __construct(Enquiry $enquiry)
    {
        $this->enquiry = $enquiry;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.blink.enquiry-activity-added')->subject($this->enquiry->contact->organisation->name . ' - New Enquiry Activity');
    }
}
