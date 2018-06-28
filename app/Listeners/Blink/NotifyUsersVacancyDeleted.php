<?php

namespace App\Listeners\Blink;

use Illuminate\Support\Facades\Mail;
use App\Events\Blink\VacancyWasDeleted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\Blink\SendVacancyRequiresWithdrawingNotification;

class NotifyUsersVacancyDeleted implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     *
     * @param  VacancyWasDeleted $event
     * @return void
     */
    public function handle(VacancyWasDeleted $event)
    {
        if ($this->hasSavedStatus($event)) {
            return;
        }

        Mail::to(config('vandango.blink.vacancies.email'))
            ->send(new SendVacancyRequiresWithdrawingNotification($event->vacancy));
    }

    /**
     * @param VacancyWasDeleted $event
     * @return bool
     */
    private function hasSavedStatus(VacancyWasDeleted $event)
    {
        return $event->vacancy->status()->name == config('vandango.blink.statuses.vacancy-saved');
    }
}
