<?php

namespace App\Console\Commands\Blink;

use App\Blink\Models\Status;
use App\Blink\Models\Enquiry;
use Illuminate\Console\Command;
use App\Blink\Models\Organisation;
use Illuminate\Support\Facades\Mail;
use App\Pics\Learner as DatastoreLearner;
use App\Pics\Organisation as DatastoreOrganisation;
use App\Mail\Blink\QualifiedEnquiryHasNoRecordedRevenueStream;

class NotifyOwnersQualifiedEnquiryHasNoRecordedStreams extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blink:qualified-empty-streams-notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fires a notification to inform owner to opportunities or named starts have been recorded for the qualified enquiry';

    /**
     * @var
     */
    protected $qualifiedStatus;

    /**
     * @var Learner
     */
    private $learner;

    /**
     * @var Organisation
     */
    private $organisation;

    /**
     * Create a new command instance.
     *
     * @param DatastoreLearner      $learner
     * @param DatastoreOrganisation $organisation
     */
    public function __construct(DatastoreLearner $learner, DatastoreOrganisation $organisation)
    {
        parent::__construct();
        $this->learner = $learner;
        $this->organisation = $organisation;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->qualifiedStatus = Status::whereName(config('vandango.blink.statuses.qualified'))->first();

        Enquiry::all()->filter(function ($e) {
            return $this->isQualified($e->statuses->last()) && $this->hasNoRecordedRevenueStreams($e);
        })->each(function ($e) {
            $user = $e->owners->last();
            Mail::to($user->email)->send(new QualifiedEnquiryHasNoRecordedRevenueStream($e, $user));
        });
    }

    /**
     * @param $status
     * @return bool
     */
    private function isQualified($status)
    {
        return $status->id === $this->qualifiedStatus->id;
    }

    /**
     * @param $enquiry
     * @return bool
     */
    private function hasNoRecordedRevenueStreams($enquiry)
    {
        return $enquiry->opportunities->count() == 0 && $enquiry->applicants->count() == 0;
    }
}
