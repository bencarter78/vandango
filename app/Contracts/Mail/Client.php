<?php

namespace App\Contracts\Mail;

interface Client
{
    /**
     * @return Mailgun
     * @throws \HttpException
     */
    public function response();
}