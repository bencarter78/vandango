<?php

namespace App\Jobs\Pics;

use App\Jobs\Job;
use App\Pics\Organisation;
use App\Apply\Models\Applicant;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use App\Jobs\Apply\CreateApplicantAccount;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\DispatchesJobs;

class SaveOrganisation extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels, DispatchesJobs;

    /**
     * @var array
     */
    private $data;

    /**
     * Create a new job instance.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @param Organisation $pics
     * @return mixed
     */
    public function handle(Organisation $pics)
    {
        $this->createOrganisation($pics);
        $this->createApplicant();
        $this->dispatch(new CreateApplicantAccount($this->data));
    }

    /**
     * @param Organisation $pics
     */
    public function createOrganisation(Organisation $pics)
    {
        if ($this->data['place'] == '') {
            $organisation = $pics->create($this->organisation());
            $this->data['place'] = $organisation->PlaceCode;
        }
    }

    /**
     * @return array
     */
    public function organisation()
    {
        return [
            'Place' => $this->data['place'],
            'Name' => $this->data['organisation_name'],
            "Address" => [
                "Address1" => $this->data['add1'],
                "Address2" => $this->data['add2'],
                "Address3" => $this->data['add3'],
                "Address4" => $this->data['add4'],
                "Address5" => $this->data['add5'],
            ],
            'PostCode' => $this->data['postcode'],
        ];
    }

    /**
     * @void
     */
    public function createApplicant()
    {
        $applicant = Applicant::create($this->data);
        $applicant->pics_organisation_id = $this->data['place'];
        $applicant->save();
    }
}
