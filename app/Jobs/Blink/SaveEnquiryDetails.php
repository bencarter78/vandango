<?php

namespace App\Jobs\Blink;

use App\Blink\Models\Enquiry;
use App\Events\Blink\EnquiryWasAdded;

class SaveEnquiryDetails
{
    /**
     * @var array
     */
    private $data;

    /**
     * Create a new job instance.
     *
     * @param array $data
     * @param null  $id
     */
    public function __construct(array $data, $id = null)
    {
        $data['enquiry_id'] = $id;
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return mixed
     */
    public function handle()
    {
        if ( ! $this->isDuplicateEnquiry()) {
            $this->data['organisation'] = dispatch(new SaveOrganisation($this->data));
            $this->data['contact'] = dispatch(new SaveContact($this->data));
            $this->data['enquiry'] = dispatch(new SaveEnquiry($this->data));
            $this->data['activity'] = dispatch(new SaveActivity($this->data['enquiry'], $this->data));

            event(new EnquiryWasAdded($this->data['enquiry']));
        }

        return $this->data['enquiry'];
    }

    /**
     *
     */
    private function isDuplicateEnquiry()
    {
        $match = $this->hasMatch();

        if ($match->count() === 1) {
            $this->data['enquiry'] = $match->first();

            return true;
        }
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection|static[]
     */
    private function hasMatch()
    {
        return Enquiry::where('employee_count', isset($this->data['organisation_size']) ? $this->data['organisation_size'] : null)
                      ->where('location', $this->data['organisation_location'])
                      ->whereHas('contact', function ($q) {
                          $q->whereHas('organisation', function ($q) {
                              $q->whereName($this->data['search']['organisation_id']);
                          })
                            ->where(function ($q) {
                                $q->where('tel', $this->data['contact_tel'])
                                  ->orWhere('email', $this->data['contact_email']);
                            });
                      })
                      ->get();
    }
}
