<?php

namespace App\Services\Mail;

trait Headers
{
    /**
     * Add headers to the email
     *
     * @return $this;
     */
    public function addHeaders()
    {
        $this->withSwiftMessage(function ($m) {
            foreach ($this->headers as $key => $value) {
                $m->getHeaders()->addTextHeader($key, $value);
            }
        });

        return $this;
    }

}