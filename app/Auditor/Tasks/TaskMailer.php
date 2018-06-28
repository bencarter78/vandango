<?php

namespace App\Auditor\Tasks;

use TCK\Mailman\Mailman;

class TaskMailer extends Mailman
{
    /**
     * @param $recipient
     * @param $data
     * @return bool
     */
    public function sendTaskNotification($recipient, $data)
    {
        $view = 'emails.totalpeople.blank';
        $data['content'] = $data['content'];
        $data['headers'] = ['X-Mailgun-Tag' => 'auditor'];
        $data['from'] = 'hello@totalpeople.co.uk';
        $data['fname'] = 'Total People';

        return $this->sendTo($recipient, $data['subject'], $view, $data);
    }

}