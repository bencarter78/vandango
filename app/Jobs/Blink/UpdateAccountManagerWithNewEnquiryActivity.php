<?php

namespace App\Jobs\Blink;

use App\Blink\Models\Enquiry;
use Illuminate\Bus\Queueable;
use App\Mail\Blink\EnquiryActivity;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateAccountManagerWithNewEnquiryActivity implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Enquiry
     */
    private $enquiry;

    /**
     * Create a new job instance.
     *
     * @param Enquiry $enquiry
     */
    public function __construct(Enquiry $enquiry)
    {
        $this->enquiry = $enquiry;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->enquiry->hasOwner()) {
            Mail::to($this->enquiry->owner()->email)->send(new EnquiryActivity($this->enquiry));
        }
    }
}
