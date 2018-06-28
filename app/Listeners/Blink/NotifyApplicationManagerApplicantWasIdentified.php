<?php

namespace App\Listeners\Blink;

use App\Events\Apply\StartWasIdentified;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\Blink\ApplicantWasAddedToEnquiry;

class NotifyApplicationManagerApplicantWasIdentified implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     *
     * @param  StartWasIdentified $event
     * @return void
     */
    public function handle(StartWasIdentified $event)
    {
        $event->applicant->enquiry->vacancies->each(function ($vacancy) use ($event) {
            if ($vacancy->enquiry->hasOwner()
                && (( ! $vacancy->applicationManager) || $vacancy->applicationManager->is($vacancy->enquiry->currentOwner))) {
                return;
            }

            $vacancy->applicationManager->notify(new ApplicantWasAddedToEnquiry($event->applicant));
        });
    }
}
