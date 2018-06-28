<?php

namespace App\Http\ViewComposers\Forum;

use App\Forum\Trending;

class TrendingComposer
{
    /**
     * @var Channel
     */
    private $trending;

    /**
     * @param Trending $trending
     */
    function __construct(Trending $trending)
    {
        $this->trending = $trending;
    }

    /**
     * @param $view
     */
    public function compose($view)
    {
        $view->with('trendingThreads', $this->trending->get());
    }
} 