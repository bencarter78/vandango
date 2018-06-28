<?php

namespace App\Console\Commands\Nas;

use App\Models\Nas\Region;
use App\Services\NasClient;
use Illuminate\Console\Command;

class SyncRegions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nas:sync-regions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync regions with NAS';

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
        $data = (new NasClient($this->wsdl))->request('GetRegion');

        foreach ($data->Regions->RegionData as $r) {
            Region::updateOrCreate(
                ['code' => $r->CodeName],
                ['name' => $r->FullName]
            );
        }
    }
}
