<?php

namespace App\Console\Commands\Nas;

use App\Services\NasClient;
use Illuminate\Console\Command;

class VacancyDetail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nas:detail {ref}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Return vacancy summary for a given reference number';

    /**
     * @var string
     */
    protected $wsdl = 'https://soapapi.findapprenticeship.service.gov.uk/Services/VacancyDetails/VacancyDetails51.svc?WSDL';

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
     * @throws \App\Exceptions\NasSoapException
     */
    public function handle()
    {
        $data = (new NasClient($this->wsdl))->requestFromMethod('Get', [
            'VacancySearchCriteria' => [
                'VacancyReferenceId' => $this->argument('ref'),
                'VacancyLocationType' => 'NonNational',
                'PageIndex' => 1,
            ],
        ]);

        dd($data);
    }
}
