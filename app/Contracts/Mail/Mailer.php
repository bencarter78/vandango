<?php

namespace App\Contracts\Mail;

interface Mailer {

    /**
     * @param $recipient
     * @return mixed
     */
    public function to($recipient);

    /**
     * @param $recipient
     * @return mixed
     */
    public function cc($recipient);

    /**
     * @param $recipient
     * @return mixed
     */
    public function bcc($recipient);

    /**
     * @param $message
     * @return mixed
     */
    public function send($message);

    /**
     * @param $message
     * @return mixed
     */
    public function queue($message);

    /**
     * @param $message
     * @return mixed
     */
    public function later($message);
}