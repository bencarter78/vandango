<?php
namespace App\Contracts;


interface HttpClient
{
    public function get($url, $params = []);

    public function post($url, $options = [], $params = []);

    public function put($url, $options = [], $params = []);

    public function patch($url, $options = [], $params = []);

    public function request($method, $url, $options = [], $params = []);

    public function getContents();
}