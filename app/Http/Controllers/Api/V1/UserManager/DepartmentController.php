<?php

namespace App\Http\Controllers\Api\V1\UserManager;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use App\UserManager\Users\UserRepository;
use App\UserManager\Departments\DepartmentRepository;

class DepartmentController extends Controller
{
    /**
     * @var UserRepository
     */
    private $departments;

    /**
     * UserController constructor.
     *
     * @param $departments
     */
    public function __construct(DepartmentRepository $departments)
    {
        $this->departments = $departments;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->departments->getAll('department', 'asc', ['manager', 'sectors', 'ad']);
    }

}
