<?php

namespace App\Jobs\Apply;

use Carbon\Carbon;
use App\Apply\Models\Applicant;
use App\Events\Apply\StartWasIdentified;

class SaveApplicant
{
    /**
     * @var array
     */
    private $data;

    /**
     * Create a new job instance.
     *
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $applicant = Applicant::firstOrCreate([
            'first_name' => $this->data['first_name'],
            'surname' => $this->data['surname'],
            'dob' => isset($this->data['dob']) ? Carbon::createFromFormat('d/m/Y', $this->data['dob'])->format('Y-m-d') : null,
            'sector_id' => $this->data['sector_id'],
            'programme_type' => $this->data['programme_type'],
            'qualification_plan_id' => $this->data['qualification_plan_id']
        ], [
            'user_id' => $this->data['user_id'],
            'enquiry_id' => $this->data['enquiry_id'],
            'adviser_id' => $this->data['adviser_id'],
            'email' => $this->data['email'],
            'first_name' => $this->data['first_name'],
            'surname' => $this->data['surname'],
            'sector_id' => $this->data['sector_id'],
            'programme_type' => $this->data['programme_type'],
            'qualification_plan_id' => $this->data['qualification_plan_id'],
            'starting_on' => Carbon::createFromFormat('d/m/Y', $this->data['starting_on'])->format('Y-m-d'),
            'dob' => Carbon::createFromFormat('d/m/Y', $this->data['dob'])->format('Y-m-d'),
        ]);

        event(new StartWasIdentified($applicant));
    }
}
