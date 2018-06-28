<?php

namespace App\Console\Commands\Apply;

use App\Services\Mail\Events;
use Carbon\Carbon;
use Illuminate\Console\Command;

class InvitationStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'invite:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks the status of the invitation email of an applicant';

    /**
     * @var Events
     */
    private $events;

    /**
     * Create a new command instance.
     *
     * @param Events $events
     */
    public function __construct(Events $events)
    {
	parent::__construct();
	$this->events = $events;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
	$date = Carbon::now();
	$events = $this->events->filter([
	    'begin' => $date->timestamp,
	    'end' => $date->subDays(30)->timestamp,
	    'tags' => 'apply-invite',
	])->delivered()->get();

	dd( $events );
    }
}
