<?php

namespace App\Listeners\Blink;

use App\Blink\Models\Status;
use App\Events\Blink\AccountManagerWasUpdated;

class SetStatusToUnqualified
{
    /**
     * Handle the event.
     *
     * @param  AccountManagerWasUpdated $event
     * @return void
     */
    public function handle(AccountManagerWasUpdated $event)
    {
        if ($event->enquiry->status()->is(Status::pending())) {
            $event->enquiry->addStatus(Status::unqualified(), $event->user->id);
        }
    }
}
