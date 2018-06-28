<?php

namespace App\Mail\Auditor;

use App\Auditor\Tasks\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Services\Mail\Headers;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TaskResult extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels, Headers;

    /**
     * @var Task
     */
    private $task;

    /**
     * @var
     */
    public $content;

    /**
     * @var
     */
    private $defaultView = 'auditor.emails.notification';

    /**
     * @var array
     */
    private $headers = ['X-Mailgun-Tag' => 'auditor'];

    /**
     * Create a new message instance.
     *
     * @param Task $task
     * @param      $content
     */
    public function __construct(Task $task, $content)
    {
        $this->task = $task;
        $this->content = $content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mailer = $this->addHeaders()
                       ->subject($this->task->title)
                       ->view($this->getView());

        if ($this->task->reply_to) {
            $mailer->replyTo($this->task->reply_to);
        }

        return $mailer;
    }

    /**
     * @return string
     */
    public function getView()
    {
        if ($this->task->template) {
            return $this->task->template->view;
        }

        return $this->defaultView;
    }
}
