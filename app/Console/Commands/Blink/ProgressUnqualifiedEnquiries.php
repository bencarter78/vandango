<?php

namespace App\Console\Commands\Blink;

use App\Blink\Models\Enquiry;
use App\Jobs\Blink\ProgressEntity;
use Illuminate\Console\Command;

class ProgressUnqualifiedEnquiries extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blink:progress-unqualified';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Progresses unqualified enquiries to qualified';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Enquiry::all()->each(function ($e) {
            if ($e->hasStatus(config('vandango.blink.statuses.unqualified'))) {
                if (
                    $e->opportunities->count() > 0
                    || $e->vacancies->count() > 0
                    || $e->applicants->count() > 0
                ) {
                    $this->line('Progressing enquiry for ' . $e->contact->organisation->name);
                    dispatch(new ProgressEntity($e, $e->owners->last()->id));
                }
            }
        });
    }
}
