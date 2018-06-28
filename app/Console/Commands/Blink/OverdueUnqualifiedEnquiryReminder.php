<?php

namespace App\Console\Commands\Blink;

use App\Blink\Models\Status;
use App\Blink\Models\Enquiry;
use App\Mail\Blink\UnqualifiedEnquiryNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class OverdueUnqualifiedEnquiryReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blink:unqualified-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fires reminders when unqualified enquiries have not been updated';

    /**
     * @var
     */
    protected $unqualifiedStatus;

    /**
     * @var int
     */
    protected $daysOffset = 7;

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
        $this->unqualifiedStatus = Status::whereName(config('vandango.blink.statuses.unqualified'))->first();

        Enquiry::all()->filter(function ($e) {
            $status = $e->statuses->last();

            return $this->isUnqualified($status) && $this->isOverDue($status);
        })->each(function ($e) {
            Mail::to($e->owners->last()->email)->send(new UnqualifiedEnquiryNotification($e));
        });
    }

    /**
     * @param $status
     * @return bool
     */
    private function isUnqualified($status)
    {
        return $status->id === $this->unqualifiedStatus->id;
    }

    /**
     * @param $status
     * @return bool
     */
    private function isOverDue($status)
    {
        return $status->pivot->created_at <= Carbon::today()->subDays($this->daysOffset);
    }
}
