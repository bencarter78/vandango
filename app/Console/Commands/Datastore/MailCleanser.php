<?php

namespace App\Console\Commands\Datastore;

use Mail;
use Carbon\Carbon;
use App\Contracts\Datastore;
use App\Services\Mail\Events;
use Illuminate\Console\Command;

class MailCleanser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'datastore:mail-cleanse {type} {--tags=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends an email to remove the email address from the datastore (PICS)';

    /**
     * @var Events
     */
    private $events;

    /**
     * @var Datastore
     */
    private $datastore;

    /**
     * @var
     */
    protected $bounces;

    /**
     * @var array
     */
    protected $recipients = [];

    /**
     * The email address where the notifications will be sent to.
     *
     * @var string
     */
    protected $admin = 'sheryl.hannon@totalpeople.co.uk';

    /**
     * Create a new command instance.
     *
     * @param Events    $events
     * @param Datastore $datastore
     */
    public function __construct(Events $events, Datastore $datastore)
    {
        parent::__construct();
        $this->events = $events;
        $this->datastore = $datastore;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if ( ! $this->hasBounces()) {
            return;
        }

        $this->findBouncesInDatastore();

        if ($this->getRecipients()) {
            $this->send();
        }
    }

    /**
     * @return mixed
     * @throws \HttpResponseException
     */
    public function hasBounces()
    {
        $this->queryMailEvents();

        if (count($this->bounces) > 0) {
            return true;
        }
    }

    /**
     * Takes each bounced email address and tried to find the record
     * in the datastore (PICS)
     */
    public function findBouncesInDatastore()
    {
        foreach ($this->bounces as $bounced) {

            // If no SQL query then break from loop
            if ( ! $this->sql($bounced->recipient)) {
                break;
            }

            $result = $this->datastore->query($this->sql($bounced->recipient));

            if ($result) {
                $this->setRecipients($result[0]);
            }
        }
    }

    /**
     * @return mixed
     * @throws \HttpResponseException
     */
    public function queryMailEvents()
    {
        $date = Carbon::now();

        $this->setBounces(
            $this->events->filter([
                'begin' => $date->timestamp,
                'end' => $date->subDays(1)->timestamp,
                'tags' => $this->option('tags'),
            ])->hardBounces()->get()
        );
    }

    /**
     * @return mixed
     */
    public function send()
    {
        $data['recipients'] = $this->getRecipients();
        $subject = ucfirst($this->argument('type')) . ' Bounced Emails';

        return Mail::send('emails.datastore.emails-bounced', $data, function ($m
        ) use ($subject) {
            $m->to($this->admin)
              ->subject($subject);
        });
    }

    /**
     * @param $email
     * @return string
     */
    public function sql($email)
    {
        $email = strtolower($email);

        if ($this->argument('type') == 'learner') {
            return "
                  SELECT email, t.ident, t.firstname, t.surname
                  FROM pctrndet
                  LEFT JOIN trainee t 
                  ON t.ident = pctrndet.ident 
                  WHERE LOWER(pctrndet.email) = '$email'
            ";
        }

        // TODO: Query for employers
    }

    /**
     * @return mixed
     */
    public function getBounces()
    {
        return $this->bounces;
    }

    /**
     * @param mixed $bounces
     */
    public function setBounces($bounces)
    {
        $this->bounces = $bounces;
    }

    /**
     * @return array
     */
    public function getRecipients()
    {
        return $this->recipients;
    }

    /**
     * @param array $learner
     */
    public function setRecipients($learner)
    {
        $this->recipients[] = $learner;
    }
}
