<?php

namespace App\Listeners\Blink;

use App\Events\Blink\EnquiryWasCompleted;

class DeleteOpportunities
{
    /**
     * Handle the event.
     *
     * @param  EnquiryWasCompleted $event
     * @return void
     */
    public function handle(EnquiryWasCompleted $event)
    {
        return $event->enquiry->opportunities->each->delete();
    }
}
