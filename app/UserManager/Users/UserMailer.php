<?php

namespace App\UserManager\Users;

use TCK\Mailman\Mailman;

class UserMailer extends Mailman
{
    /**
     * @deprecated
     * No longer letting people know of their account. Needs deleting.
     *
     * @param $user
     * @param $password
     * @return bool
     */
    public function welcome($user, $password)
    {
        return $this->sendTo($user, 'Welcome to VanDango', 'emails.auth.welcome', ['password' => $password]);
    }

    /**
     * @param $user
     * @return bool
     */
    public function resetPassword($user)
    {
        return $this->sendTo($user, 'VanDango - Password Reset Request', 'emails.auth.reset', null);
    }

    /**
     * @param $user
     * @param $password
     * @return bool
     */
    public function sendNewPassword($user, $password)
    {
        return $this->sendTo($user, 'VanDango - New Password Information', 'emails.auth.newpassword', ['newPassword' => $password]);
    }

    /**
     * @param $user
     * @param $newUser
     * @return bool
     */
    public function notifyManagerOfNewUser($user, $newUser)
    {
        return $this->sendTo($user, 'New Staff Member', 'emails.usermanager.new-user', ['newUser' => $newUser]);
    }

    /**
     * @param $manager
     * @param $user
     * @return bool
     */
    public function userEndingProbationTodayNotification($manager, $user)
    {
        return $this->sendTo($manager, 'Probation Ending Today', 'emails.usermanager.user-probation-ends-today', [
            'staff' => $user,
            'cc' => 'hr@totalpeople.co.uk',
        ]);
    }

    /**
     * @param $manager
     * @param $user
     * @return bool
     */
    public function userEndingProbationInMonthNotification($manager, $user)
    {
        return $this->sendTo($manager, 'Probation Ending This Month', 'emails.usermanager.user-probation-ends-in-month', [
            'staff' => $user,
            'cc' => 'hr@totalpeople.co.uk',
        ]);
    }

    /**
     * @param $manager
     * @param $user
     * @return bool
     */
    public function probationHasEndedNotification($manager, $user)
    {
        return $this->sendTo($manager, "{$user->present()->name}'s Probation Ended", 'emails.usermanager.user-probation-has-ended', [
            'staff' => $user,
            'cc' => 'hr@totalpeople.co.uk',
        ]);
    }

    /**
     * @param $manager
     * @param $user
     * @return bool
     */
    public function probationHasBeenExtendedNotification($manager, $user)
    {
        return $this->sendTo($manager, "{$user->present()->name}'s Probation Extended", 'emails.usermanager.user-probation-was-extended', [
            'staff' => $user,
            'cc' => 'hr@totalpeople.co.uk',
        ]);
    }

    /**
     * @param $user
     * @return bool
     */
    public function appraisalDueNotification($user)
    {
        return $this->sendTo($user, "{$user->first_name}, Your Appraisal Is Due", 'emails.usermanager.user-appraisal-due', [
            'cc' => implode(', ', collect($user->managers())->pluck('email')->all()),
        ]);
    }
}