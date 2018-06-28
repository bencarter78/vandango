<?php

namespace App\Events\Blink;

use App\Blink\Models\Enquiry;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class EnquiryWasCompleted
{
    use Dispatchable, SerializesModels;

    /**
     * @var Enquiry
     */
    public $enquiry;

    /**
     * Create a new event instance.
     *
     * @param Enquiry $enquiry
     */
    public function __construct(Enquiry $enquiry)
    {
        $this->enquiry = $enquiry;
    }
}
