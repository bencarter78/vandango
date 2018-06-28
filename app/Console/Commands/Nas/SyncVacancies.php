<?php

namespace App\Console\Commands\Nas;

use Carbon\Carbon;
use App\Services\NasClient;
use App\Nas\Models\Vacancy;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Exceptions\NasSoapException;

class SyncVacancies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nas:sync-vacancies {page=1}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get all national vacancies for apprenticeships and traineeships';

    /**
     * @var string
     */
    protected $wsdl = 'https://soapapi.findapprenticeship.service.gov.uk/Services/VacancyDetails/VacancyDetails51.svc?WSDL';

    /**
     * @var
     */
    protected $totalPages = 1;

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->totalPages = $this->argument('page');

        for ($i = $this->totalPages; $i <= $this->totalPages; $i++) {
            try {
                $this->line('Page ' . $i . ' of ' . $this->totalPages);
                $this->saveVacancies($i);
            } catch (NasSoapException $e) {
                $this->error("Error from page $i");
                Log::error("Error from page $i");
            }
        }
    }

    /**
     * @param $i
     * @throws NasSoapException
     */
    private function saveVacancies($i)
    {
        $this->requestVacancies($i)->each(function ($v) {
            $data = (array)$v;
            $data['ClosingDate'] = Carbon::createFromFormat('Y-m-d\TH:i:s', $v->ClosingDate);
            $data['InterviewFromDate'] = Carbon::createFromFormat('Y-m-d\TH:i:s', $v->InterviewFromDate);
            $data['PossibleStartDate'] = Carbon::createFromFormat('Y-m-d\TH:i:s', $v->PossibleStartDate);
            $data['VacancyAddress'] = $v->VacancyAddress->Town != '' ? $v->VacancyAddress->Town : $v->VacancyAddress->County;
            $data['EmployerDescription'] = substr($v->EmployerDescription, 0, 50000);
            Vacancy::updateOrCreate(['VacancyReference' => $data['VacancyReference']], $data);
        });
    }

    /**
     * @param $page
     * @return \Illuminate\Support\Collection
     * @throws NasSoapException
     */
    private function requestVacancies($page)
    {
        $response = (new NasClient($this->wsdl))->requestFromMethod('Get', [
            'VacancySearchCriteria' => [
                'VacancyLocationType' => 'NonNational',
                'PageIndex' => $page,
            ],
        ]);

        $this->totalPages = $response->SearchResults->TotalPages;

        return collect($response->SearchResults->SearchResults->VacancyFullData);
    }
}
