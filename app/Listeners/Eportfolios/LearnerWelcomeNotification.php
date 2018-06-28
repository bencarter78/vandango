<?php

namespace App\Listeners\Eportfolios;

use Illuminate\Support\Facades\Mail;
use App\Mail\Apply\WelcomeToTotalPeople;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\Eportfolios\AccountWasCreated;

class LearnerWelcomeNotification implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     *
     * @param  AccountWasCreated $event
     * @return void
     */
    public function handle(AccountWasCreated $event)
    {
        Mail::to($event->eportfolio->applicant->email)
            ->cc($event->eportfolio->applicant->adviser->email)
            ->send(new WelcomeToTotalPeople($event->eportfolio));
    }
}
