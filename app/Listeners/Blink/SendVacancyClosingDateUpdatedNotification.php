<?php

namespace App\Listeners\Blink;

use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\Blink\VacancyClosingDateUpdated;
use App\Events\Blink\VacancyClosingDateWasChanged;

class SendVacancyClosingDateUpdatedNotification implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     *
     * @param  VacancyClosingDateWasChanged $event
     * @return void
     */
    public function handle(VacancyClosingDateWasChanged $event)
    {
        Mail::to(config('vandango.blink.vacancies.email'))->send(new VacancyClosingDateUpdated($event->vacancy));
    }
}
