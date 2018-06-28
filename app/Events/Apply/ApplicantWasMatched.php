<?php

namespace App\Events\Apply;

use App\Apply\Models\Applicant;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class ApplicantWasMatched
{
    use Dispatchable, SerializesModels;

    /**
     * @var Applicant
     */
    public $applicant;

    /**
     * Create a new event instance.
     *
     * @param Applicant $applicant
     */
    public function __construct(Applicant $applicant)
    {
        $this->applicant = $applicant;
    }
}
