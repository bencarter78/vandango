<?php

namespace App\Console\Commands\Pics;

use Carbon\Carbon;
use App\Contracts\HttpClient;
use App\Apply\Models\Applicant;
use Illuminate\Console\Command;
use App\Apply\Models\Withdrawal;
use App\Events\Apply\ApplicantWasMatched;

class CheckForStarts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pics:check-starts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Looks for applicants who have been registered with PICS.';

    /**
     * @var HttpClient
     */
    private $client;

    /**
     * Create a new command instance.
     *
     * @param HttpClient $client
     */
    public function __construct(HttpClient $client)
    {
        parent::__construct();
        $this->client = $client;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->line('Checking applicants by ident...');
        $this->checkApplicantsByIdent();

        $this->line('Checking applicants by details...');
        $this->checkApplicantsByDetails();
    }

    /**
     * Checks for a start on PICS where applicant has been uploaded to PICS as an applicant
     */
    private function checkApplicantsByIdent()
    {
        Applicant::whereNotNull('applicant_ident')->whereNull('episode_ident')->get()->each(function ($applicant) {
            $this->line("Searching PICS for $applicant->name's Applicant IDENT [$applicant->applicant_ident]'");

            $this->client->request('get', config('vandango.papi.base') . "/v2/applicants/starts/$applicant->applicant_ident");

            $data = collect($this->client->getContents());

            if (count($data) > 0) {
                $this->updateApplicant($applicant, $data->first());
            }
        });
    }

    /**
     * Checks for a start on PICS where applicant has not been uploaded to PICS as an applicant
     */
    private function checkApplicantsByDetails()
    {
        Applicant::whereNull('episode_ident')->get()->each(function ($applicant) {
            $this->line("Searching PICS for $applicant->name's Applicant IDENT [$applicant->applicant_ident]'");
            try {
                $this->line("Searching PICS for $applicant->name's surname [$applicant->surname]'");

                $query = collect(explode("'", $applicant->surname))->last();
                $this->client->request('get', config('vandango.papi.base') . "/v3/learners/search?q=$query");
                $data = collect($this->client->getContents());

                if ($data->count() > 0) {
                    $match = $data->filter(function ($l) use ($applicant) {
                        return strtolower(trim($l->surname)) == strtolower($applicant->surname)
                            && $l->tr_start >= $applicant->starting_on->subWeeks(12)->format('Y-m-d')
                            && str_contains(trim($l->site), $applicant->sector->code)
                            && str_contains(strtolower(trim($l->firstname)), strtolower($applicant->first_name));
                    });

                    if ($match->count() > 0) {
                        $this->info('Match found!');
                        $this->updateApplicant($applicant, $match->first());
                    }
                }
            } catch (\Exception $e) {
                $this->error($applicant->name);
            }
        });
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
        $this->error("IDENT is already recorded, marking as duplicate");
        $withdrawal = Withdrawal::where('name', config('vandango.apply.withdrawals.duplicate'))->firstOrFail();
        $applicant->withdraw($withdrawal->id);
    }
}
