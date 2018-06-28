<?php

namespace App\Listeners\Apply;

use App\Pics\Applicant;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use App\Events\Apply\StartWasIdentified;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreatePicsApplication implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /**
     * @var
     */
    private $applicant;

    /**
     * @var Applicant
     */
    private $pics;

    /**
     * Create the event listener.
     *
     * @param Applicant $pics
     * @internal param HttpClient $client
     */
    public function __construct(Applicant $pics)
    {
        $this->pics = $pics;
    }

    /**
     * Handle the event.
     *
     * @param  StartWasIdentified $event
     * @return void
     */
    public function handle(StartWasIdentified $event)
    {
        $applicant = $event->applicant;

        if (env('APP_ENV') != 'production' || $applicant->applicant_ident) {
            return;
        }

        $data = [
            'Forename' => $applicant->first_name,
            'Surname' => $applicant->surname,
            'Email' => $applicant->email,
            'PlannedStart' => isset($applicant->starting_on) ? "/Date({$applicant->starting_on->timestamp}000)/" : null,
            'Cohort' => $applicant->sector->code,
            'Site' => $applicant->sector->code,
            'QualPlan' => $applicant->qualification_plan_id ? $applicant->qualificationPlan->code : 'APPLICANT',
            'EmployerCode' => $applicant->pics_organisation_id,
            'ExportStatus' => ['code' => '02'],
        ];

        if (isset($data->dob)) {
            $applicant['DateOfBirth'] = "/Date({$data->dob->timestamp}000)/";
        }

        try {
            $applicant->update(['applicant_ident' => $this->pics->create($data)->ApIdent]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
