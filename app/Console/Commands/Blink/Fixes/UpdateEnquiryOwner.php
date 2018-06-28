<?php

namespace App\Console\Commands\Blink\Fixes;

use App\Blink\Models\Enquiry;
use Illuminate\Console\Command;

class UpdateEnquiryOwner extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blink:patch-enquiry-owner';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Upgrade patch to add current enquiry owner to enquiry record';

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
        Enquiry::withTrashed()->get()->each(function ($enquiry) {
            try {
                $this->info($enquiry->owner()->id);
                $enquiry->update(['owner_id' => $enquiry->owner()->id]);
            } catch (\Exception $e) {
                $this->error($enquiry->id);
            }
        });
    }
}
