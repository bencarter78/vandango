<?php

namespace App\Console\Commands\Nas;

use Illuminate\Console\Command;

class UploadVacancy extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nas:upload';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Uploads a vacncy to NAS';

    /**
     * @var string
     */
    protected $namespace = 'http://services.imservices.org.uk/AVMS/Interfaces/5.1';

    /**
     * @var string
     */
    protected $wsdl = 'https://soapapi.findapprenticeship.service.gov.uk/Services/VacancyManagement/VacancyManagement51.svc?WSDL';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $client = new SoapClient($this->wsdl, ['trace' => true]);

        $client->__setSoapHeaders([
            new SoapHeader($this->namespace, 'PublicKey', env('NAS_PASSWORD')),
            new SoapHeader($this->namespace, 'MessageId', Uuid::uuid4()->toString()),
            new SoapHeader($this->namespace, 'ExternalSystemId', env('NAS_ID')),
        ]);

        try {
            //            $response = $client->GetApprenticeshipFrameworks();
            $response = $client->GetErrorCodes();

            dd($response);
        } catch (SoapFault $e) {
            //            var_dump($client->__getLastRequestHeaders());
            //            var_dump($client->__getLastRequest());
            $this->error($e->getMessage());
            dd($e->getTraceAsString());
        }
    }
}
