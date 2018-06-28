<?php

namespace App\Jobs\Auditor;

use App\Jobs\Job;
use App\Auditor\Tasks\Task;
use Illuminate\Mail\Mailer;
use App\Services\MessageParser;
use App\Mail\Auditor\TaskResult;
use Illuminate\Support\Collection;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\Auditor\EmailAddressNotValid;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\Auditor\TaskRunnerStageWasReached;

class SendAuditResultNotification extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /**
     * @var Task
     */
    private $task;

    /**
     * @var
     */
    protected $message;

    /**
     * @var array
     */
    protected $recipients = [];

    /**
     * @var
     */
    private $picsData;

    /**
     * @var
     */
    private $mailer;

    /**
     * @var
     */
    private $parser;

    /**
     * @var string
     */
    private $adminEmail = 'programme.admin@totalpeople.co.uk';

    /**
     * Create a new job instance.
     *
     * @param Task $task
     * @param      $picsData
     */
    public function __construct(Task $task, $picsData)
    {
        $this->task = $task;
        $this->picsData = $picsData;
    }

    /**
     * Execute the job.
     *
     * @param Mailer        $mailer
     * @param MessageParser $parser
     */
    public function handle(Mailer $mailer, MessageParser $parser)
    {
        $this->setMailer($mailer);
        $this->setParser($parser);
        $this->setRecipients($this->task->recipients);
        $this->setMessage($this->task->notification, $this->picsData);

        foreach ($this->getRecipients() as $recipient) {

            event(new TaskRunnerStageWasReached($this->task, [
                'msg' => "Sending notification to $recipient",
            ]));

            $mailer->to($recipient)->queue(new TaskResult($this->task, $this->getMessage()));
        }
    }

    /**
     * @param mixed $mailer
     */
    private function setMailer($mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @param mixed $parser
     */
    private function setParser($parser)
    {
        $this->parser = $parser;
    }

    /**
     * @param $recipients
     * @return $this
     */
    private function setRecipients($recipients)
    {
        $emails = preg_split('/, ?/', $recipients);
        foreach ($emails as $email) {
            $email = $this->getEmail(trim($email));
            if ($email) {
                $this->recipients[] = trim($email);
            }
        }
    }

    /**
     * Check to see if the $email is a valid email. If not it will
     * be using a key to extract from the PICS data set.
     *
     * @param $email
     * @return string
     */
    private function getEmail($email)
    {
        if ( ! $email || $email == '') {
            return;
        }

        if ($this->isValidEmail($email)) {
            return $email;
        }

        $email = $this->extractEmailFromVariable($email);

        if ( ! $this->isValidEmail($email) && $email != '') {
            $this->sendInvalidEmailNotification($email);
        }

        return $email;
    }

    /**
     * @param $email
     * @return bool
     */
    private function isValidEmail($email)
    {
        return filter_var(trim($email), FILTER_VALIDATE_EMAIL);
    }

    /**
     * @return bool
     */
    private function dataIsGrouped()
    {
        return count($this->picsData) > 1;
    }

    /**
     * @param $email
     */
    private function sendInvalidEmailNotification($email)
    {
        $this->mailer->to($this->adminEmail)->queue(new EmailAddressNotValid($email, $this->task->title));
    }

    /**
     * @param $email
     * @return mixed
     */
    private function extractEmailFromVariable($email)
    {
        $key = preg_replace("/[{}]/", '', $email);

        return $this->dataIsGrouped() || $this->picsData instanceof Collection
            ? $this->picsData->first()->{$key}
            : $this->picsData->{$key};
    }

    /**
     * @return mixed
     */
    private function getMessage()
    {
        return $this->message;
    }

    /**
     * @return array
     */
    public function getRecipients()
    {
        return $this->recipients;
    }

    /**
     * @param mixed $message
     * @return $this
     */
    private function setMessage($message)
    {
        $this->message = $this->parser->parse($message, $this->picsData);
    }

}
