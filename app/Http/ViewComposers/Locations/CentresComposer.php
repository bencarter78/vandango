<?php

namespace App\Http\ViewComposers\Locations;

use App\Locations\Centre;
use Illuminate\Cache\Repository;

class CentresComposer
{
    /**
     * @var
     */
    protected $centre;

    /**
     * @var Repository
     */
    private $cache;

    /**
     * @param Centre     $centre
     * @param Repository $cache
     */
    function __construct(Centre $centre, Repository $cache)
    {
        $this->centre = $centre;
        $this->cache = $cache;
    }

    /**
     * @param $view
     */
    public function compose($view)
    {
        if ( ! $this->cache->has('centres')) {
            $this->cache->forever('centres', $this->centre->orderBy('name', 'ASC')->get());
        }
        $view->with('centres', $this->cache->get('centres'));
    }

} 