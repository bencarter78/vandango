<?php

namespace App\Listeners\Apply;

use Illuminate\Support\Facades\Mail;
use App\Events\Apply\StartWasIdentified;
use App\Mail\Apply\ApplicantNeedsAdviser;

class SendApplicantRequiresAdviserNotification
{
    /**
     * Handle the event.
     *
     * @param  StartWasIdentified $event
     * @return void
     */
    public function handle(StartWasIdentified $event)
    {
        if ( ! $event->applicant->adviser_id) {
            $manager = $event->applicant->sector->department->manager;

            Mail::to($manager->email)
                ->send(new ApplicantNeedsAdviser($event->applicant));
        }
    }
}
