<?php

namespace App\Http\ViewComposers\Judi;

use App\Judi\Repositories\GradeRepository;

class GradeComposer
{
    /**
     * @var GradeRepository
     */
    protected $grades;

    /**
     * @param GradeRepository $grades
     */
    function __construct(GradeRepository $grades)
    {
        $this->grades = $grades;
    }

    /**
     * @param $view
     */
    public function compose($view)
    {
        $view->with('grades', $this->grades->getAll());
    }

}