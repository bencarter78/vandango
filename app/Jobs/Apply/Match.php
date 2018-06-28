<?php

namespace App\Jobs\Apply;

use Carbon\Carbon;
use App\Contracts\HttpClient;
use App\Apply\Models\Applicant;
use App\Apply\Models\Withdrawal;
use App\Events\Apply\ApplicantWasMatched;

class Match
{
    /**
     * @var Applicant
     */
    private $applicant;

    /**
     * Create a new command instance.
     *
     * @param Applicant $applicant
     */
    public function __construct(Applicant $applicant)
    {
        $this->applicant = $applicant;
    }

    /**
     * Execute the console command.
     *
     * @param HttpClient $client
     * @return mixed
     */
    public function handle(HttpClient $client)
    {
        if ($this->checkApplicantsByIdent($client)) {
            return true;
        }

        return $this->checkApplicantsByDetails($client);
    }

    /**
     * Checks for a start on PICS where applicant has been uploaded to PICS as an applicant
     *
     * @param $client
     * @return mixed
     */
    private function checkApplicantsByIdent($client)
    {
        if ( ! $this->applicant->applicant_ident) {
            return;
        }
        
        $client->request('get', config('vandango.papi.base') . "/v2/applicants/starts/{$this->applicant->applicant_ident}");

        $data = collect($client->getContents());

        if (count($data) > 0) {
            return $this->updateApplicant($this->applicant, $data->first());
        }
    }

    /**
     * Checks for a start on PICS where applicant has not been uploaded to PICS as an applicant
     *
     * @param $client
     * @return mixed
     */
    private function checkApplicantsByDetails($client)
    {
        $query = collect(explode("'", $this->applicant->surname))->last();

        $client->request('get', config('vandango.papi.base') . "/v3/learners/search?q=$query");

        $data = collect($client->getContents());

        if ($data->count() > 0) {
            $match = $data->filter(function ($l) {
                return strtolower(trim($l->surname)) == strtolower($this->applicant->surname)
                    && $l->tr_start >= $this->applicant->starting_on->subWeeks(12)->format('Y-m-d')
                    && str_contains(trim($l->site), $this->applicant->sector->code)
                    && str_contains(strtolower(trim($l->firstname)), strtolower($this->applicant->first_name));
            });

            if ($match->count() > 0) {
                return $this->updateApplicant($this->applicant, $match->first());
            }
        }
    }

    /**
     * @param $applicant
     * @param $data
     * @return mixed
     */
    private function updateApplicant($applicant, $data)
    {
        if ($this->isUniqueIdent($data)) {
            $applicant->update([
                'episode_ident' => $data->ident,
                'started_on' => Carbon::createFromFormat('Y-m-d', $data->tr_start),
            ]);

            event(new ApplicantWasMatched($applicant));

            return;
        }

        return $this->markAsDuplicate($applicant);
    }

    /**
     * @param $data
     * @return bool
     */
    private function isUniqueIdent($data)
    {
        return Applicant::where('episode_ident', $data->ident)->count() === 0;
    }

    /**
     * @param $applicant
     * @return mixed
     */
    private function markAsDuplicate($applicant)
    {
        $withdrawal = Withdrawal::where('name', config('vandango.apply.withdrawals.duplicate'))->firstOrFail();
        $applicant->withdraw($withdrawal->id);
    }
}
