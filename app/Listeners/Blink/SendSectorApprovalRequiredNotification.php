<?php

namespace App\Listeners\Blink;

use Illuminate\Support\Facades\Mail;
use App\Events\Blink\VacancyWasReceived;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\Blink\VacancyApprovalRequired;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendSectorApprovalRequiredNotification implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     *
     * @param  VacancyWasReceived $event
     * @return void
     */
    public function handle(VacancyWasReceived $event)
    {
        $user = $this->vacancyApprover($event);

        Mail::to($user->email)
            ->cc($event->vacancy->sector->department->manager->email)
            ->send(new VacancyApprovalRequired($event->vacancy, $user));
    }

    /**
     * @param VacancyWasReceived $event
     */
    private function vacancyApprover(VacancyWasReceived $event)
    {
        $users = $event->vacancy->sector->users->filter(function ($user) {
            return $user->hasRole(config('vandango.blink.roles.approver'));
        });


        if ($users->count() > 0) {
            return $users->random();
        }

        return $event->vacancy->sector->department->manager;
    }
}
