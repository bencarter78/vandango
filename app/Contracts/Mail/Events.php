<?php

namespace App\Contracts\Mail;

interface Events
{
    /**
     * @return mixed
     * @throws \HttpResponseException
     */
    public function get();

    /**
     * @return mixed
     * @throws \HttpResponseException
     */
    public function all();

    /**
     * @return Events
     */
    public function accepted();

    /**
     * @return Events
     */
    public function rejected();

    /**
     * @return Events
     */
    public function delivered();

    /**
     * @return Events
     */
    public function failed();

    /**
     * @return Events
     */
    public function opened();

    /**
     * @return Events
     */
    public function clicked();

    /**
     * @return Events
     */
    public function hardBounces();

    /**
     * @return Events
     */
    public function softBounces();

    /**
     * By default it sets the requested time frame to the last 30 days
     */
    public function initTimeFrame();

    /**
     * @param array $params
     * @return $this
     */
    public function filter(array $params);
}