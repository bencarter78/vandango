<?php

namespace App\Listeners\UserManager;

use App\UserManager\Users\UserMailer;
use App\UserManager\Users\UserRepository;
use App\Events\UserManager\UserWasRegistered;

class SendNewUserNotificationToManager
{
    /**
     * @var UserMailer
     */
    private $mailer;

    /**
     * @var UserRepository
     */
    private $user;

    /**
     * Create the event handler.
     *
     * @param UserMailer     $mailer
     * @param UserRepository $user
     */
    public function __construct(UserMailer $mailer, UserRepository $user)
    {
        $this->mailer = $mailer;
        $this->user = $user;
    }

    /**
     * Handle the event.
     *
     * @param  UserWasRegistered $event
     * @return void
     */
    public function handle(UserWasRegistered $event)
    {
        $newUser = $event->getUser();
        if ($newUser->departments->count() > 0) {
            $manager = $this->user->requireById($newUser->departments->first()->manager_id);
            $this->mailer->notifyManagerOfNewUser($manager, $newUser);
        }
    }
}
