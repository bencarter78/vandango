<?php

namespace App\Console\Commands\Pics;

use App\Apply\Models\Applicant;
use App\Pics\Applicant as Pics;
use Illuminate\Console\Command;

class RegisterApplicant extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pics:register-applicant';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Register applicants with PICS';

    /**
     * @var Pics
     */
    private $pics;

    /**
     * Create a new command instance.
     *
     * @param Pics $pics
     */
    public function __construct(Pics $pics)
    {
        parent::__construct();
        $this->pics = $pics;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Applicant::whereNull('applicant_ident')->whereNull('episode_ident')->get()->each(function ($a) {
            try {
                $this->line('Importing ' . $a->first_name . ' ' . $a->surname);
                $a->update(['applicant_ident' => $this->createPicsAccount($a)->ApIdent]);
                $this->info('Successfully imported applicant.');
            } catch (\Exception $e) {
                $this->error("Could not create PICS applicant for Applicant Id: {$a->id}", $e->getMessage());
            }
        });
    }

    /**
     * @param $data
     * @return mixed
     */
    private function createPicsAccount($data)
    {
        $applicant = [
            'Forename' => $data->first_name,
            'Surname' => $data->surname,
            'Email' => isset($data->email) ? $data->email : null,
            'PlannedStart' => "/Date({$data->starting_on->timestamp}000)/",
            'Cohort' => $data->sector->code,
            'Site' => $data->sector->code,
            'QualPlan' => $data->qual_plan ? $data->qual_plan : 'APPLICANT',
            'EmployerCode' => $data->pics_organisation_id,
            'ExportStatus' => ['code' => '02'],
        ];

        if (isset($data->dob)) {
            $applicant['DateOfBirth'] = "/Date({$data->dob->timestamp}000)/";
        }

        return $this->pics->create($applicant);
    }
}
