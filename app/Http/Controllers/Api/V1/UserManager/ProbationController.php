<?php

namespace App\Http\Controllers\Api\V1\UserManager;

use App\Http\Controllers\Controller;
use App\UserManager\Users\UserRepository;

class ProbationController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $users;

    /**
     * ProbationController constructor.
     *
     * @param $users
     */
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return $this->users->getAllOnProbation();
    }
}

