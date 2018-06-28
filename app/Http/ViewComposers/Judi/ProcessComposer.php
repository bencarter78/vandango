<?php

namespace App\Http\ViewComposers\Judi;

use App\Judi\Repositories\ProcessRepository;

class ProcessComposer
{
    /**
     * @var ProcessRepository
     */
    protected $processes;

    /**
     * @param ProcessRepository $processes
     */
    function __construct(ProcessRepository $processes)
    {
        $this->processes = $processes;
    }

    /**
     * @param $view
     */
    public function compose($view)
    {
        $view->with('processes', $this->processes->getAll('name'));
    }

}