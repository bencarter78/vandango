<?php

namespace App\Http\ViewComposers\Judi;

use App\Judi\Repositories\CriteriaRepository;

class CriteriaComposer
{
    /**
     * @var CriteriaRepository
     */
    protected $criteria;

    /**
     * @param CriteriaRepository $criteria
     */
    function __construct(CriteriaRepository $criteria)
    {
        $this->criteria = $criteria;
    }

    /**
     * @param $view
     */
    public function compose($view)
    {
        $view->with('criteria', $this->criteria->getAll('name'));
    }

}