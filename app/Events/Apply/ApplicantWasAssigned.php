<?php

namespace App\Events\Apply;

use Illuminate\Queue\SerializesModels;

class ApplicantWasAssigned
{
    use SerializesModels;

    /**
     * @var
     */
    public $applicant;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($applicant)
    {
        $this->applicant = $applicant;
    }
}
