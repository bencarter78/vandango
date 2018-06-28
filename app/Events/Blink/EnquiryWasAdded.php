<?php

namespace App\Events\Blink;

use Illuminate\Queue\SerializesModels;

class EnquiryWasAdded
{
    use SerializesModels;

    /**
     * @var
     */
    public $enquiry;

    /**
     * Create a new event instance.
     *
     * @param $enquiry
     */
    public function __construct($enquiry)
    {
        $this->enquiry = $enquiry;
    }
}
