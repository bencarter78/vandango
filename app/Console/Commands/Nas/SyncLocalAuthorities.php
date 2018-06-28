<?php

namespace App\Console\Commands\Nas;

use App\Services\NasClient;
use Illuminate\Console\Command;
use App\Models\Nas\LocalAuthority;

class SyncLocalAuthorities extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nas:sync-las';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync local authorities with NAS';

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
        $data = (new NasClient($this->wsdl))->request('GetLocalAuthorities');

        foreach ($data->LocalAuthorities->LocalAuthorityData as $la) {
            LocalAuthority::updateOrCreate(
                ['county' => $la->County],
                [
                    'full_name' => $la->FullName,
                    'short_name' => $la->ShortName,
                ]
            );
        }
    }
}
