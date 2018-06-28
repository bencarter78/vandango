<?php

namespace App\Console\Commands\Eportfolio;

use Illuminate\Console\Command;
use App\Apply\Models\Applicant;
use App\Jobs\Eportfolios\CreateAccount;

class Registration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'onefile:register';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Register applicants for Onefile';

    /**
     * Create a new command instance.
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
        Applicant::whereHas('eportfolio', function ($q) {
            $q->whereNull('username');
        })
                 ->whereHas('adviser')
                 ->get()
                 ->each(function ($applicant) {
                     dispatch(new CreateAccount($applicant));
                 });
    }
}
