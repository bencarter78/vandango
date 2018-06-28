<?php

namespace App\Contracts\Services;

interface Messenger
{
    public function to($recipient);

    public function from($sender);

    public function send($message);
}