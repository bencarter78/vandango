<?php

namespace App\Http\ViewComposers\Forum;

use App\Forum\Channel;

class ChannelsComposer
{
    /**
     * @var Channel
     */
    private $channel;

    /**
     * @param Channel $channel
     */
    function __construct(Channel $channel)
    {
        $this->channel = $channel;
    }

    /**
     * @param $view
     */
    public function compose($view)
    {
        $view->with('channels', Channel::orderBy('name')->get());
    }
} 