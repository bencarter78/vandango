<?php

namespace App\Http\ViewComposers\UserManager;

use App\UserManager\Departments\DepartmentRepository;

class DepartmentComposer
{
    /**
     * @var DepartmentInterface
     */
    protected $departments;

    /**
     * @param DepartmentRepository $departments
     */
    function __construct(DepartmentRepository $departments)
    {
        $this->departments = $departments;
    }

    /**
     * @param $view
     */
    public function compose($view)
    {
        $view->with('departments', $this->departments->getAll('department'));
    }

}