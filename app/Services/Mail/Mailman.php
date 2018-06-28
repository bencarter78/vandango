<?php

namespace App\Services\Mail;

use App\Contracts\Mail\Mailer;
use Illuminate\Contracts\Mail\Mailer as Mail;

class Mailman implements Mailer
{
    /**
     * @var Mail
     */
    private $mail;

    /**
     * Mailman constructor.
     *
     * @param $mail
     */
    public function __construct(Mail $mail)
    {
        $this->mail = $mail;
    }

    /**
     * @param $recipient
     * @return this
     */
    public function to($recipient)
    {
        $this->mail->to($recipient);

        return $this;
    }

    /**
     * @param $recipient
     * @return this
     */
    public function cc($recipient)
    {
        $this->mail->cc($recipient);

        return $this;
    }

    /**
     * @param $recipient
     * @return this
     */
    public function bcc($recipient)
    {
        $this->mail->bcc($recipient);

        return $this;
    }

    /**
     * @param $message
     * @return mixed
     */
    public function send($message)
    {
        return $this->mail->send($message);
    }

    /**
     * @param $message
     * @return mixed
     */
    public function queue($message)
    {
        return $this->mail->queue($message);
    }

    /**
     * @param $message
     * @return mixed
     */
    public function later($message)
    {
        return $this->mail->later($message);
    }
}