<?php

namespace App\Listeners\Blink;

use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\Blink\UserAssignedApplicationManager;
use App\Events\Blink\ApplicationManagerWasAssigned;

class SendApplicationManagerAssignedToVacancyNotification implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     *
     * @param  ApplicationManagerWasAssigned $event
     * @return void
     */
    public function handle(ApplicationManagerWasAssigned $event)
    {
        if ($this->vacancyHasBeenAssigned($event) && ! $this->applicationManagerIsSubmittor($event)) {
            Mail::to($event->vacancy->applicationManager->email)
                ->send(new UserAssignedApplicationManager($event->vacancy));
        }
    }

    /**
     * @param ApplicationManagerWasAssigned $event
     * @return mixed
     */
    private function vacancyHasBeenAssigned(ApplicationManagerWasAssigned $event)
    {
        return $event->vacancy->application_manager_id;
    }

    /**
     * @param ApplicationManagerWasAssigned $event
     * @return bool
     */
    private function applicationManagerIsSubmittor(ApplicationManagerWasAssigned $event)
    {
        return $event->vacancy->application_manager_id === $event->vacancy->submitted_by;
    }
}
