<?php

namespace App\Services\Mail;

use Mailgun\Mailgun;
use App\Contracts\Mail\Client as MailService;
use Http\Adapter\Guzzle6\Client as HttpClient;

class Client implements MailService
{
    /**
     * @var Mailgun
     */
    protected $client;

    /**
     * @var mixed
     */
    protected $domain;

    /**
     * @var
     */
    protected $endpoint;

    /**
     * @var array
     */
    protected $params = [];

    /**
     * MailService constructor.
     */
    public function __construct()
    {
        $this->client = new Mailgun(
            env('MAILGUN_SECRET'), new HttpClient()
        );
    }

    /**
     * @return Mailgun
     * @throws \HttpException
     */
    public function response()
    {
        return $this->client->get(
            env('MAILGUN_DOMAIN') . '/' . $this->endpoint,
            $this->params
        );
    }
}