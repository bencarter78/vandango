<?php

namespace App\Http\ViewComposers\Locations;

use App\Locations\PostTown;
use Illuminate\Contracts\Cache\Repository;

class PostTownsComposer
{
    /**
     * @var PostTown
     */
    protected $postTowns;

    /**
     * @var Repository
     */
    private $cache;

    /**
     * @param PostTown   $postTowns
     * @param Repository $cache
     */
    function __construct(PostTown $postTowns, Repository $cache)
    {
        $this->postTowns = $postTowns;
        $this->cache = $cache;
    }

    /**
     * @param $view
     */
    public function compose($view)
    {
        if ( ! $this->cache->has('postTowns')) {
            $this->cache->forever('postTowns', $this->postTowns->orderBy('postTown', 'ASC')->get());
        }
        $view->with('postTowns', $this->cache->get('postTowns'));
    }
} 