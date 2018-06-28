<?php

namespace App\Services\Mail;

use Carbon\Carbon;
use App\Contracts\Mail\Events as MailEvents;

class Events extends Client implements MailEvents
{
    /**
     * @var string
     */
    protected $endpoint = 'events';

    /**
     * @var array
     */
    protected $params = ['limit' => 100];

    /**
     * Events constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->initTimeFrame();
    }

    /**
     * @return mixed
     * @throws \HttpResponseException
     */
    public function get()
    {
        $response = $this->response();

        if ($response->http_response_code === 200) {
            return $response->http_response_body->items;
        }

        throw new \HttpResponseException(
            "Bad request - {$response->http_response_code}. No data returned."
        );
    }

    /**
     * @return mixed
     * @throws \HttpResponseException
     */
    public function all()
    {
        return $this->get();
    }

    /**
     * @return Events
     */
    public function accepted()
    {
        return $this->filter(['event' => 'accepted']);
    }

    /**
     * @return Events
     */
    public function rejected()
    {
        return $this->filter(['event' => 'rejected']);
    }

    /**
     * @return Events
     */
    public function delivered()
    {
        return $this->filter(['event' => 'delivered']);
    }

    /**
     * @return Events
     */
    public function failed()
    {
        return $this->filter(['event' => 'failed']);
    }

    /**
     * @return Events
     */
    public function opened()
    {
        return $this->filter(['event' => 'opened']);
    }

    /**
     * @return Events
     */
    public function clicked()
    {
        return $this->filter(['event' => 'clicked']);
    }

    /**
     * @return Events
     */
    public function hardBounces()
    {
        return $this->filter([
            'event' => 'failed',
            'severity' => 'permanent',
        ]);
    }

    /**
     * @return Events
     */
    public function softBounces()
    {
        return $this->filter([
            'event' => 'failed',
            'severity' => 'temporary',
        ]);
    }

    /**
     * Tags to include for the query
     *
     * @param $tags array
     * @return Events
     */
    public function tags($tags)
    {
        if (is_array($tags)) {
            $tags = implide(',', $tags);
        }

        return $this->filter(['tags' => $tags]);
    }

    /**
     * By default it sets the requested time frame to the last 30 days
     */
    public function initTimeFrame()
    {
        $this->filter(['begin' => Carbon::now()->timestamp]);
    }

    /**
     * Start of the timeframe to be used
     *
     * @param $begin
     * @return Events
     */
    public function begin($begin)
    {
        return $this->filter(['begin' => $begin]);
    }

    /**
     * End of the timeframe to be used
     *
     * @param $end
     * @return Events
     */
    public function end($end)
    {
        return $this->filter(['end' => $end]);
    }

    /**
     * The number of events you want to return.
     * Note: Max 300
     *
     * @param $limit
     * @return Events
     */
    public function limit($limit)
    {
        return $this->filter(['limit' => $limit]);
    }

    /**
     * @param array $params
     * @return $this
     */
    public function filter(array $params)
    {
        $this->params = array_merge($this->params, $params);

        return $this;
    }

}