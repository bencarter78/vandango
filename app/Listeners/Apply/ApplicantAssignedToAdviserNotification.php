<?php

namespace App\Listeners\Apply;

use App\Mail\Apply\ApplicantAssignedToAdviser;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\Apply\ApplicantWasAssigned;
use Illuminate\Contracts\Queue\ShouldQueue;

class ApplicantAssignedToAdviserNotification implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     *
     * @param  ApplicantWasAssigned $event
     * @return void
     */
    public function handle(ApplicantWasAssigned $event)
    {
        Mail::to($event->applicant->adviser->email)->send(new ApplicantAssignedToAdviser($event->applicant));
    }
}
