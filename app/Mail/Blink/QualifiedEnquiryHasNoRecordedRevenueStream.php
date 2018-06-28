<?php

namespace App\Mail\Blink;

use App\Blink\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Blink\Models\Enquiry;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class QualifiedEnquiryHasNoRecordedRevenueStream extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * @var Enquiry
     */
    public $enquiry;

    /**
     * @var User
     */
    public $user;

    /**
     * Create a new message instance.
     *
     * @param Enquiry $enquiry
     * @param User    $user
     */
    public function __construct(Enquiry $enquiry, User $user)
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
        return $this->view('emails.blink.enquiry-revenue-stream-reminder')
                    ->subject("Enquiry with {$this->enquiry->contact->organisation->name} has no opportunities or named starts recorded");
    }
}
