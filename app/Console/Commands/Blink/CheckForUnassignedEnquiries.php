<?php

namespace App\Console\Commands\Blink;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Blink\Repositories\Enquiries;
use App\Mail\Blink\AssignEnquiryNotification;

class CheckForUnassignedEnquiries extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blink:enquiries-unassigned';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks for unassigned enquiries older than the delay offset';

    /**
     * @var Enquiries
     */
    private $enquiries;

    /**
     * Create a new command instance.
     *
     * @param Enquiries $enquiries
     */
    public function __construct(Enquiries $enquiries)
    {
        parent::__construct();
        $this->enquiries = $enquiries;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->enquiries->getUnassigned()->each(function ($enquiry) {
            if ($this->selfAssignTimeHasExpired($enquiry)) {
                Mail::to(config('vandango.blink.admin.email'))->send(new AssignEnquiryNotification($enquiry));
            }
        });
    }

    /**
     * @param $enquiry
     * @return bool
     */
    private function selfAssignTimeHasExpired($enquiry)
    {
        return $enquiry->created_at <= Carbon::now()->subMinutes(config('vandango.blink.admin.notificationDelay'));
    }
}
