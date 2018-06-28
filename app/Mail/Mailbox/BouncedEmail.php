<?php

namespace App\Mail\Mailbox;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BouncedEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var array
     */
    protected $headers = ['X-Mailgun-Tag' => 'mailbox'];

    /**
     * @var
     */
    private $data;

    /**
     * @var
     */
    public $tag;

    /**
     * @var
     */
    public $sent_on;

    /**
     * @var
     */
    public $recipient;

    /**
     * @var
     */
    public $title;

    /**
     * Create a new message instance.
     *
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->setTag($this->data->tags);
        $this->setSentOn($this->data->timestamp);
        $this->setRecipient($this->data->recipient);
        $this->setTitle($this->data->message->headers->subject);

        return $this->subject('Bounced Email Address')
                    ->view('emails.mailbox.bounced');
    }

    /**
     * @param mixed $tags
     */
    public function setTag($tags)
    {
        $this->tag = count($tags) > 0 ? implode(', ', $tags) : 'Unknown';
    }

    /**
     * @param mixed $timestamp
     */
    public function setSentOn($timestamp)
    {
        $this->sent_on = Carbon::createFromTimestamp($timestamp)->format('d/m/Y');
    }

    /**
     * @param mixed $recipient
     */
    public function setRecipient($recipient)
    {
        $this->recipient = $recipient;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }
}
