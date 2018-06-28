<?php

namespace App\Services;

use SoapFault;
use SoapClient;
use SoapHeader;
use Ramsey\Uuid\Uuid;
use App\Exceptions\NasSoapException;

class NasClient
{
    /**
     * @var SoapClient
     */
    protected $client;

    /**
     * @var string
     */
    protected $namespace = 'http://services.imservices.org.uk/AVMS/Interfaces/5.1';

    /**
     * NasClient constructor.
     *
     * @param $wsdl
     */
    public function __construct($wsdl)
    {
        $this->client = new SoapClient($wsdl, ['trace' => true]);

        $this->client->__setSoapHeaders([
            new SoapHeader($this->namespace, 'PublicKey', env('NAS_PASSWORD')),
            new SoapHeader($this->namespace, 'MessageId', Uuid::uuid4()->toString()),
            new SoapHeader($this->namespace, 'ExternalSystemId', env('NAS_ID')),
        ]);
    }

    /**
     * @param $service
     * @param $data
     * @return mixed
     * @throws NasSoapException
     */
    public function request($service, $data = [])
    {
        $this->client->__soapCall($service, $data);

        try {
            return $this->client->__soapCall($service, $data);
        } catch (SoapFault $e) {
            throw new NasSoapException($e->faultcode);
        }
    }

    /**
     * Use when service requires the method to be called
     * // TODO: Understand why this works only as a method and not the function call from __soapCall()
     *
     * @param $service
     * @param $data
     * @return mixed
     * @throws NasSoapException
     */
    public function requestFromMethod($service, $data = [])
    {
        try {
            return $this->client->{$service}($data);
        } catch (SoapFault $e) {
            throw new NasSoapException($e->faultcode);
        }
    }
}