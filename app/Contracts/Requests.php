<?php

namespace App\Contracts;

interface Requests
{
    public function request($method, $uri, $options);

    public function get($uri, $options);

    public function post($uri, $options);
}