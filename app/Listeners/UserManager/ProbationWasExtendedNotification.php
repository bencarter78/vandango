<?php

namespace App\Listeners\UserManager;

use App\UserManager\Users\UserMailer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\UserManager\ProbationEndDateWasUpdated;

class ProbationWasExtendedNotification implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * @var UserMailer
     */
    private $mailer;

    /**
     * Create the event listener.
     *
     * @param UserMailer $mailer
     */
    public function __construct(UserMailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Handle the event.
     *
     * @param  ProbationEndDateWasUpdated $event
     * @return void
     */
    public function handle(ProbationEndDateWasUpdated $event)
    {
        if ($event->newEndDate) {
            foreach ($event->user->getManagers() as $manager) {
                $this->mailer->probationHasBeenExtendedNotification($manager, $event->user);
            }
        }
    }
}
