<?php
namespace App\Jobs\Auditor;

use App\Jobs\Job;
use Carbon\Carbon;
use App\Auditor\Tasks\Task;
use App\Auditor\Tasks\TaskMailer;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class SendNotification
 *
 * @package App\Jobs\Auditor
 * @deprecated Use App\Jobs\Auditor\SendAuditResultNotification instead
 */
class SendNotification extends Job implements ShouldQueue
{
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
     * @param TaskMailer $mailer
     */
    public function handle(TaskMailer $mailer)
    {
        $this->setRecipients($this->task->recipients);
        $this->setMessage($this->task->notification);
        $this->parseMessage($this->picsData);
        $this->sendNotification($mailer);
    }

    /**
     * @param TaskMailer $mailer
     */
    public function sendNotification(TaskMailer $mailer)
    {
        foreach ($this->getRecipients() as $recipient) {
            $mailer->sendTaskNotification($recipient, [
                'content' => $this->getMessage(),
                'subject' => $this->task->title,
            ]);
        }
    }

    /**
     * Substitutes the parameters with values from the query
     *
     * @param $result
     */
    public function parseMessage($result)
    {
        foreach (get_object_vars($result) as $key => $value) {
            $variable = $this->findVariableFromKey($key);
            $this->setMessage(str_replace(
                $variable,
                trim($this->valueFormatter($variable, $result->{$key})),
                $this->getMessage()
            ));
        }
    }

    /**
     * @param $key
     * @return mixed
     */
    public function findVariableFromKey($key)
    {
        preg_match("/{(?={$key})\w+.*?}/", $this->getMessage(), $matches);
        if ($matches) {
            return $matches[0];
        }

        return $key;
    }

    /**
     * @param $variable
     * @param $value
     * @return mixed
     */
    public function valueFormatter($variable, $value)
    {
        if ( ! str_contains($variable, '|')) {
            return $value;
        }

        $elements = preg_split("/[|:]/", $this->extractVariableName($variable));

        if ($elements[1] === 'date') {
            return Carbon::createFromFormat('Y-m-d', $value)->format($elements[2]);
        }
    }

    /**
     * @return array
     */
    public function getRecipients()
    {
        return $this->recipients;
    }

    /**
     * @param $recipients
     */
    public function setRecipients($recipients)
    {
        $emails = preg_split('/, ?/', $recipients);
        foreach ($emails as $email) {
            $this->recipients[] = $this->filterEmail($email);
        }
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return mixed
     */
    public function getPicsData()
    {
        return $this->picsData;
    }

    /**
     * @param mixed $picsData
     */
    public function setPicsData($picsData)
    {
        $this->picsData = $picsData;
    }

    /**
     * @param $variable
     * @return mixed
     */
    public function extractVariableName($variable)
    {
        return preg_replace("/[{}]/", '', $variable);
    }

    /**
     * @param $email
     * @return string
     */
    public function filterEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            return trim($this->getPicsData()->{$this->extractVariableName($email)});
        }

        return trim($email);
    }

}
