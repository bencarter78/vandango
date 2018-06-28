<?php

namespace App\Http\ViewComposers\UserManager;

use App\UserManager\Sectors\SectorRepository;

class SectorComposer
{
    /**
     * @var SectorInterface
     */
    protected $sectors;

    /**
     * @param SectorRepository $sectors
     */
    function __construct(SectorRepository $sectors)
    {
        $this->sectors = $sectors;
    }

    /**
     * @param $view
     */
    public function compose($view)
    {
        $view->with('sectors', $this->sectors->getAll('name'));
    }

}