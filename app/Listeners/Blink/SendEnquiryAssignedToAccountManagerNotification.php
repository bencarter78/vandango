<?php

namespace App\Listeners\Blink;

use Illuminate\Support\Facades\Mail;
use App\Mail\Blink\EnquiryAssignment;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\Blink\AccountManagerWasUpdated;

class SendEnquiryAssignedToAccountManagerNotification implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     *
     * @param  AccountManagerWasUpdated $event
     * @return void
     */
    public function handle(AccountManagerWasUpdated $event)
    {
        if ($event->user->id !== $event->enquiry->activities->first()->updated_by) {
            Mail::to($event->user->email)
                ->send(new EnquiryAssignment($event->enquiry, $event->user));
        }
    }
}
