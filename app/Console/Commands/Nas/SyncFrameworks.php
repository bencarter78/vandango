<?php

namespace App\Console\Commands\Nas;

use App\Services\NasClient;
use App\Models\Nas\Framework;
use Illuminate\Console\Command;

class SyncFrameworks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nas:sync-frameworks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync frameworks with NAS';

    /**
     * @var string
     */
    protected $wsdl = 'https://soapapi.findapprenticeship.service.gov.uk/Services/ReferenceData/ReferenceData51.svc?WSDL';

    /**
     * SyncReferenceData constructor.
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
        $data = (new NasClient($this->wsdl))->request('GetApprenticeshipFrameworks');

        foreach ($data->ApprenticeshipFrameworks->ApprenticeshipFrameworkAndOccupationData as $fwk) {
            Framework::updateOrCreate(
                ['code' => $fwk->ApprenticeshipFrameworkCodeName],
                [
                    'full_name' => $fwk->ApprenticeshipFrameworkFullName,
                    'short_name' => $fwk->ApprenticeshipFrameworkShortName,
                    'occupation_code' => $fwk->ApprenticeshipOccupationCodeName,
                    'occupation_full_name' => $fwk->ApprenticeshipOccupationFullName,
                    'occupation_short_name' => $fwk->ApprenticeshipOccupationShortName,
                ]
            );
        }
    }
}
