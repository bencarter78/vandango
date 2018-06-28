<?php

namespace App\Console\Commands\Blink;

use App\Blink\Models\Enquiry;
use Illuminate\Console\Command;

class DeleteCompletedEnquiries extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blink:delete-completed-enquiries';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deletes enquiries from a status imported from the Portal';

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
        $total = Enquiry::count();
        $this->line("Total Enquiries: $total");
        Enquiry::whereHas('statuses', function ($q) {
            $q->whereType('completed');
        })->get()->each(function ($e) {
            $e->delete();
        });
    }
}
