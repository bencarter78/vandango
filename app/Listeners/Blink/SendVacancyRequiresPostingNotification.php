<?php

namespace App\Listeners\Blink;

use Illuminate\Support\Facades\Mail;
use App\Events\Blink\VacancyWasApproved;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\Blink\VacancyRequiresPosting;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendVacancyRequiresPostingNotification implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     *
     * @param  VacancyWasApproved $event
     * @return void
     */
    public function handle(VacancyWasApproved $event)
    {
        Mail::to(config('vandango.blink.vacancies.email'))->queue(new VacancyRequiresPosting($event->vacancy));
    }
}
