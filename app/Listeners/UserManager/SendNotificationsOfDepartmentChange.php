<?php

namespace App\Listeners\UserManager;

use Swift_RfcComplianceException;
use App\UserManager\Users\UserMailer;
use App\UserManager\Departments\Department;
use App\Events\UserManager\UserMembershipsWereUpdated;

class SendNotificationsOfDepartmentChange
{
    /**
     * @var Department
     */
    private $model;

    /**
     * @var UserMailer
     */
    private $mailer;

    /**
     * Create the event listener.
     *
     * @param Department $model
     * @param UserMailer $mailer
     */
    public function __construct(Department $model, UserMailer $mailer)
    {
        $this->model = $model;
        $this->mailer = $mailer;
    }

    /**
     * Handle the event.
     *
     * @param  UserMembershipsWereUpdated $event
     * @return void
     */
    public function handle(UserMembershipsWereUpdated $event)
    {
        $user = $event->getUser();
        collect($event->getRequest()->department_id)->each(function ($dept) use ($user) {
            if ($this->userNotInDepartment($dept, $user)) {
                $this->sendNotification($user, $dept);
            }
        });
    }

    /**
     * @param $dept
     * @param $user
     * @return bool
     */
    private function userNotInDepartment($dept, $user)
    {
        return ! in_array($dept, $user->departments->pluck('id')->all());
    }

    /**
     * @param $user
     * @param $dept
     */
    private function sendNotification($user, $dept)
    {
        try {
            $this->mailer->notifyManagerOfNewUser($this->model->find($dept)->manager, $user);
        } catch (Swift_RfcComplianceException $e) {
            return;
        }
    }
}
