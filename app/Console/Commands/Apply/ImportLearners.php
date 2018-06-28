<?php

namespace App\Console\Commands\Apply;

use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Apply\Models\Applicant;
use App\Pics\QualificationPlan;
use App\UserManager\Users\User;
use App\UserManager\Sectors\Sector;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Cache;

class ImportLearners extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'apply:import-learners';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import learners from PICS';

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
        if ( ! Cache::has('import-learners')) {
            Cache::put('import-learners', Excel::load(storage_path('app/learners.xls'), function ($reader) {
            })->get(), Carbon::now()->addHour());
        }

        Cache::get('import-learners')->each(function ($applicant) {
            if ( ! $this->attemptMatch($applicant)) {
                $this->error("No match found for $applicant->first_name $applicant->surname");
                $this->line("Creating record...");

                try {
                    $this->createRecord($applicant);
                } catch (\Exception $e) {
                    $this->error("Could not create record for [$applicant->episode_ident] $applicant->adviser_id, {$e->getMessage()}, {$e->getLine()}");
                    //                    dd( $applicant );
                }
            }
        });
    }

    /**
     * @param $applicant
     */
    private function createRecord($applicant)
    {
        $adviser = $this->getUser($applicant->adviser_id);
        $sector = $this->getSector($applicant->sector_id);
        $qualPlan = $this->getQualPlan($applicant->qualification_plan_id);

        Applicant::create([
            'enquiry_id' => null,
            'adviser_id' => $adviser->id,
            'user_id' => $adviser->id,
            'applicant_ident' => $applicant->applicant_ident,
            'episode_ident' => $applicant->episode_ident,
            'email' => $applicant->email,
            'dob' => $applicant->dob->format('Y-m-d'),
            'first_name' => $applicant->first_name,
            'surname' => $applicant->surname,
            'sector_id' => $sector->id,
            'qualification_plan_id' => isset($qualPlan) ? $qualPlan->id : null,
            'qualification_plan' => null,
            'programme_type' => $applicant->programme_type,
            'starting_on' => $applicant->starting_on->format('Y-m-d'),
            'started_on' => $applicant->started_on->format('Y-m-d'),
            'pics_organisation_id' => $applicant->pics_organisation_id,
            'organisation_name' => null,
            'contact_email' => null,
            'contact_first_name' => null,
            'contact_surname' => null,
            'withdrawal_id' => null,
        ]);
    }

    /**
     * @param $applicant
     * @return \Illuminate\Database\Eloquent\Model|null|static
     */
    private function attemptMatch($applicant)
    {
        $this->line("Attempting to match $applicant->name...");
        $this->line('by IDENT...');
        $match = Applicant::where('episode_ident', $applicant->episode_ident)->first();

        if ( ! $match) {
            $this->line('by email and surname...');
            $match = Applicant::where('email', $applicant->email)
                              ->where('surname', $applicant->surname)
                              ->first();
        }

        if ( ! $match) {
            $this->line('by surname, DOB, sector and programme type...');
            $match = Applicant::where('surname', $applicant->surname)
                              ->where('dob', $applicant->dob)
                              ->where('sector_id', $this->getSector($applicant->sector_id)->id)
                              ->where('programme_type', $applicant->programme_type)
                              ->first();
        }

        if ($match) {
            $this->info("Match found for $applicant->first_name $applicant->surname");

            return $match;
        }
    }

    /**
     * @param $email
     * @return mixed
     */
    private function getUser($email)
    {
        return User::whereEmail($email)->first();
    }

    /**
     * @param $code
     * @return mixed
     */
    private function getSector($code)
    {
        return Sector::whereCode($code)->first();
    }

    /**
     * @param $code
     * @return mixed
     */
    private function getQualPlan($code)
    {
        return QualificationPlan::whereCode($code)->first();
    }
}
