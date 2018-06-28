<?php

namespace App\Listeners\Blink;

use App\Mail\Blink\VacancyRejected;
use Illuminate\Support\Facades\Mail;
use App\Events\Blink\VacancyWasRejected;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendVacancyRejectedNotification implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     *
     * @param  VacancyWasRejected $event
     * @return void
     */
    public function handle(VacancyWasRejected $event)
    {
        Mail::to($event->vacancy->enquiry->owners->last()->email)
            ->send(new VacancyRejected($event->vacancy));
    }
}
