<?php

namespace App\Listeners\Apply;

use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\Apply\ApplicantWasMatched;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\Apply\OnefileAccountRequiresSyncing;

class ApplicantMatchedNotification implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     *
     * @param  ApplicantWasMatched $event
     * @return void
     */
    public function handle(ApplicantWasMatched $event)
    {
        if ($event->applicant->eportfolio && $event->applicant->eportfolio->username != null) {
            Mail::to(config('vandango.emails.programmeAdmin'))->send(new OnefileAccountRequiresSyncing($event->applicant));
        }
    }
}
