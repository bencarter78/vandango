<?php
namespace App\Mailers;

use Config;
use TCK\Mailman\Mailman;

class ErrorMailer extends Mailman
{
    /**
     * Sends the error message from the application to the Super admin
     * @param $data
     * @return bool
     */
    public function adminError($data)
    {
        $subject = 'Reported Error';
        $view = 'emails.error';

        return $this->sendTo(Config::get('vandango.superAdminEmail'), $subject, $view, $data);
    }

}