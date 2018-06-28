<?php

namespace App\Mail\Auditor;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailAddressNotValid extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * @var
     */
    public $email;

    /**
     * @var
     */
    public $task;

    /**
     * Create a new message instance.
     *
     * @param $email
     * @param $task
     */
    public function __construct($email, $task)
    {
        $this->email = $email;
        $this->task = $task;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.auditor.invalid-email-address');
    }
}
