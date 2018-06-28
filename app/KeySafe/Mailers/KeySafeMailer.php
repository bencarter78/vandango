<?php

namespace App\KeySafe\Mailers;

use TCK\Mailman\Mailman;

class KeySafeMailer extends Mailman
{
    /**
     * The email of the owner of this process
     *
     * @var string
     */
    protected $ownerEmail = 'programme.admin@totalpeople.co.uk';

    /**
     * @param $learner
     * @param $adviserEmail
     * @return bool
     */
    public function sendLearnerAccessCode($learner, $adviserEmail)
    {
        $data['learner'] = $learner;
        $view = 'emails.keysafe.access-code';
        $subject = 'Total People - Your Resource Access Link';
        $data['from'] = 'programme.admin@totalpeople.co.uk';
        $data['cc'] = $adviserEmail;
        $data['first_name'] = 'Total People';
        $data['headers'] = ['X-Mailgun-Tag' => 'keysafe'];

        return $this->sendTo($learner, $subject, $view, $data);
    }

    /**
     * @param $learner
     * @return bool
     */
    public function sendProgAdminLearnerAccessCode($learner)
    {
        $data['learner'] = $learner;
        $view = 'emails.keysafe.access-code-programme-admin';
        $subject = 'Learner Has Been Assigned A Key Code';

        return $this->sendTo($this->ownerEmail, $subject, $view, $data);
    }

    /**
     * @return bool
     */
    public function sendLowStockLevelNotification()
    {
        $view = 'emails.keysafe.low-stock-levels';
        $subject = 'VanDango - More Learner Access Keys Needed';

        return $this->sendTo($this->ownerEmail, $subject, $view);
    }

    /**
     * @param $learner
     * @return bool
     */
    public function sendLearnerHasInvalidEmailNotification($learner)
    {
        $data['learner'] = $learner;
        $view = 'emails.datastore.invalid-learner-email';
        $subject = 'VanDango KeySafe (Salonability) - Learner\'s Email Address Is Invalid';

        return $this->sendTo($this->ownerEmail, $subject, $view, $data);
    }
}