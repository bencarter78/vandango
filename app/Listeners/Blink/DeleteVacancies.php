<?php

namespace App\Listeners\Blink;

use Illuminate\Support\Facades\Mail;
use App\Events\Blink\EnquiryWasCompleted;
use App\Mail\Blink\SendVacancyRequiresWithdrawingNotification;

class DeleteVacancies
{
    /**
     * Handle the event.
     *
     * @param  EnquiryWasCompleted $event
     * @return void
     */
    public function handle(EnquiryWasCompleted $event)
    {
        $event->enquiry->vacancies->each(function ($v) {
            Mail::to(config('vandango.blink.vacancies.email'))->send(new SendVacancyRequiresWithdrawingNotification($v));
            $v->delete();
        });
    }
}
