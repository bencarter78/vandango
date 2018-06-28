<?php

namespace App\Console\Commands\Blink;

use Carbon\Carbon;
use App\Services\NasClient;
use App\Blink\Models\Status;
use Illuminate\Console\Command;
use App\Jobs\Blink\SaveActivity;
use App\Mail\Blink\VacancyIsLive;
use Illuminate\Support\Facades\Mail;
use App\Blink\Repositories\Vacancies;

class NotifyUsersSubmittedVacancyLive extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blink:vacancies-gone-live';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify users when vacancy has gone live';

    /**
     * @var Vacancies
     */
    private $vacancies;

    /**
     * Create a new command instance.
     *
     * @param Vacancies $vacancies
     */
    public function __construct(Vacancies $vacancies)
    {
        parent::__construct();
        $this->vacancies = $vacancies;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $status = Status::whereName(config('vandango.blink.statuses.vacancy-approved'))->first();

        $this->vacancies->submittedByStatus($status->id)->each(function ($v) {
            $client = new NasClient(config('vandango.nas.wsdl.vacancy-details'));

            $response = $client->requestFromMethod('Get', [
                'VacancySearchCriteria' => [
                    'VacancyReferenceId' => (int)$v->ref,
                    'VacancyLocationType' => 'NonNational',
                    'PageIndex' => 1,
                ],
            ]);

            if ($response->SearchResults->TotalPages > 0) {
                $this->notify($v, $response->SearchResults->SearchResults->VacancyFullData);

                $v->statuses()->attach(Status::whereName(config('vandango.blink.statuses.vacancy-live'))->first()->id);

                dispatch(new SaveActivity($v->enquiry, [
                    'note' => 'Vacancy is live on NAS.',
                    'due_at' => Carbon::now()->format('d/m/Y'),
                ]));
            }
        });
    }

    /**
     * @param $v
     * @param $match
     */
    private function notify($v, $match)
    {
        try {
            if ($v->contact->email != '') {
                Mail::to($v->contact->email)
                    ->cc($this->getCc($v))
                    ->send(new VacancyIsLive($v, $match->VacancyUrl));
            }
        } catch (\Exception $e) {
            $this->line("Could not send notification from vacancy id $v->id");
        };
    }

    /**
     * @param $v
     * @return array
     */
    private function getCc($v)
    {
        return collect([$v->enquiry->owners->last()->email, $this->stakeholders($v)])->unique()->all();
    }

    /**
     * @param $v
     * @return mixed
     */
    private function stakeholders($v)
    {
        return isset($v->application_manager_id)
            ? $v->applicationManager->email
            : $v->enquiry->owners->last()->email;
    }
}
