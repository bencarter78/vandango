<?php namespace App\SurveyHound;

use TCK\Mailman\Mailman;

class SurveyMailer extends Mailman
{
    /**
     * @param $recipient
     * @param $data
     * @return bool
     */
    public function sendSurvey($recipient, $data)
    {
        $data['from'] = 'hello@totalpeople.co.uk';
        $data['first_name'] = 'Total';
        $data['surname'] = 'People';
        $data['headers'] = ['X-Mailgun-Tag' => 'surveyhound'];

        return $this->sendTo(
            trim($recipient->email),
            $data['subject'],
            'emails.totalpeople.blank',
            $data
        );
    }

}