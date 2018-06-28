<?php

namespace App\Console\Commands\Nas;

use App\Models\Nas\ErrorCode;
use App\Services\NasClient;
use Illuminate\Console\Command;

class SyncErrorCodes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nas:sync-errors';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync error codes with NAS';

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
        $codes = (new NasClient($this->wsdl))->request('GetErrorCodes');
        
        foreach ($codes->ErrorCodes->ErrorCodesData as $error) {
            ErrorCode::updateOrCreate(
                ['code' => $error->InterfaceErrorCode],
                ['description' => $error->InterfaceErrorDescription]
            );
        }
    }
}
