<?php

namespace App\Console\Commands\Apply;

use App\Apply\Models\Applicant;
use App\Mail\Apply\UnmatchedApplicants;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class UnmatchedApplicantNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'apply:notify-unmatched';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify users of applicants that have gone unmatched for a given period';

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
        $applicants = Applicant::whereNull('episode_ident')->where('starting_on', '<=', Carbon::today()->subWeeks(6))->get();
        $applicants->groupBy('adviser_id')->each(function ($applicants) {
            if ($applicants->first()->adviser) {
                Mail::to($applicants->first()->adviser->email)->send(new UnmatchedApplicants($applicants));
            }
        });
    }
}
