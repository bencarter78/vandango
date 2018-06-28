<?php

namespace App\Console\Commands\Pics;

use Carbon\Carbon;
use App\Contracts\HttpClient;
use App\Apply\Models\Applicant;
use Illuminate\Console\Command;

class RecoverMiscalculatedDuplicateStarts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pics:recover-starts';

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
        $applicants = Applicant::onlyTrashed()->where('withdrawal_id', 12)->get();
        $this->checkApplicantsByIdent($applicants);
        $this->checkApplicantsByDetails($applicants);
    }

    /**
     * Checks for a start on PICS where applicant has been uploaded to PICS as an applicant
     *
     * @param $applicants
     */
    private function checkApplicantsByIdent($applicants)
    {
        $applicants->each(function ($applicant) {
            if (Carbon::createFromFormat('Y-m-d H:i:s', $applicant->deleted_at)->format('H') >= 22) {
                $this->line("Searching PICS for $applicant->name's Applicant IDENT [$applicant->applicant_ident]'");

                $this->client->request('get', config('vandango.papi.base') . "/v2/applicants/starts/$applicant->applicant_ident");

                $data = collect($this->client->getContents());

                if (count($data) > 0) {
                    return $this->updateApplicant($applicant, $data->first());
                }

                $this->error('Applicant could not be found in PICS with Applicant IDENT');
            }
        });
    }

    /**
     * Checks for a start on PICS where applicant has not been uploaded to PICS as an applicant
     *
     * @param $applicants
     */
    private function checkApplicantsByDetails($applicants)
    {
        $applicants->each(function ($applicant) {
            if (Carbon::createFromFormat('Y-m-d H:i:s', $applicant->deleted_at)->format('H') >= 22) {
                try {
                    $this->line("Searching PICS for applicant's surname [$applicant->surname]");

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
                            return $this->updateApplicant($applicant, $match->first());
                        }

                        $this->error("IDENT is already recorded as duplicate");
                    }
                } catch (\Exception $e) {
                    $this->error($applicant->name);
                }
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
            $this->info("Match found! Applicant being recorded as start");

            return $applicant->update([
                'episode_ident' => $data->ident,
                'started_on' => Carbon::createFromFormat('Y-m-d', $data->tr_start),
                'withdrawal_id' => null,
                'deleted_at' => null,
            ]);
        }
    }

    /**
     * @param $data
     * @return bool
     */
    private function isUniqueIdent($data)
    {
        return Applicant::where('episode_ident', $data->ident)->count() === 0;
    }
}
