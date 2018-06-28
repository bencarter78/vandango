<?php

namespace App\Http\ViewComposers;

use App\Applications\ApplicationRepository;
use Illuminate\Contracts\Cache\Repository as Cache;

class ApplicationsComposer
{
    /**
     * @var ApplicationInterface
     */
    protected $applications;

    /**
     * @var CacheManager
     */
    private $cache;

    /**
     * @param ApplicationRepository $applications
     * @param Cache                 $cache
     */
    function __construct(ApplicationRepository $applications, Cache $cache)
    {
        $this->applications = $applications;
        $this->cache = $cache;
    }

    /**
     * @param $view
     */
    public function compose($view)
    {
        $view->with('apps', $this->applications->getApps());
    }

}