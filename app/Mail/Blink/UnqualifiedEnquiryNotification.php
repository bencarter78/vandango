<?php

namespace App\Mail\Blink;

use App\Blink\Models\Enquiry;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UnqualifiedEnquiryNotification extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var Enquiry
     */
    public $enquiry;

    /**
     * @var
     */
    public $daysSinceCreated;

    /**
     * Create a new message instance.
     *
     * @param Enquiry $enquiry
     */
    public function __construct(Enquiry $enquiry)
    {
        $this->enquiry = $enquiry;
        $this->daysSinceCreated = $enquiry->created_at->diffInDays(Carbon::today());
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.blink.enquiry-unqualified-reminder')
                    ->subject('Action Required: Your Enquiry Requires Updating');
    }
}
