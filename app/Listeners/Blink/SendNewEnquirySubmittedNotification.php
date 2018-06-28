<?php

namespace App\Listeners\Blink;

use Illuminate\Support\Facades\Mail;
use App\Events\Blink\EnquiryWasAdded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\Blink\AssignEnquiryNotification;

class SendNewEnquirySubmittedNotification implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     *
     * @param  EnquiryWasAdded $event
     * @return void
     */
    public function handle(EnquiryWasAdded $event)
    {
        Mail::to(config('vandango.blink.admin.email'))
            ->send(new AssignEnquiryNotification($event->enquiry));
    }
}
