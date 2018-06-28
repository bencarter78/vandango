<?php

namespace App\Console\Commands\Mailbox;

use Carbon\Carbon;
use Illuminate\Mail\Mailer;
use App\Contracts\Mail\Events;
use Illuminate\Console\Command;
use App\Mail\Mailbox\BouncedEmail;

class Bounced extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mailbox:bounced';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Returns events from mailgun';

    /**
     * @var Events
     */
    private $mailEvents;

    /**
     * @var MailboxMailer
     */
    private $mailer;

    /**
     * VanDango app tags to use for checking bounces
     *
     * @var array
     */
    protected $apps = [
        'auditor' => 'nick.robertson@totalpeople.co.uk',
        'keysafe' => 'programme.admin@totalpeople.co.uk',
        'surveyhound' => 'programme.admin@totalpeople.co.uk',
        'usermanager' => 'ben.carter@totalpeople.co.uk',
    ];

    /**
     * @var array
     */
    protected $bounces;

    /**
     * Create a new command instance.
     *
     * @param Events $mailEvents
     * @param Mailer $mailer
     */
    public function __construct(Events $mailEvents, Mailer $mailer)
    {
        parent::__construct();
        $this->mailEvents = $mailEvents;
        $this->mailer = $mailer;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        return $this->getApps()->each(function ($owner, $app) {
            $this->getBouncedMailEvents($app)->each(function ($bounce) use ($app) {
                return $this->mailer->to($this->apps[$app])->queue(new BouncedEmail($bounce));
            });
        });
    }

    /**
     * @param $tag
     * @return mixed
     */
    public function getBouncedMailEvents($tag)
    {
        $events = $this->mailEvents->begin(Carbon::now()->subHour()->timestamp)
                                   ->end(Carbon::now()->timestamp)
                                   ->hardBounces()
                                   ->tags($tag)
                                   ->limit(300)
                                   ->get();

        return collect($events);
    }

    /**
     * Returns all bounced emails
     *
     * @return mixed
     */
    public function getBounces()
    {
        return $this->bounces;
    }

    /**
     * @param $tag
     * @param $bounces
     */
    public function setBounces($tag, $bounces)
    {
        foreach ($bounces as $bounce) {
            $this->bounces[$tag][] = $bounce;
        }
    }

    /**
     * @return array
     */
    public function getApps()
    {
        return collect($this->apps);
    }

    /**
     * @param array $apps
     */
    public function setApps(array $apps)
    {
        $this->apps = $apps;
    }
}
