<?php
namespace App\Http\Controllers\UserManager;

use App\Http\Controllers\Controller;
use App\UserManager\Users\UserRepository;

class DashboardController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $users;

    /**
     * DashboardController constructor.
     *
     * @param $users
     */
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('usermanager.dashboard', [
            'users' => $this->users->getNewUsers(),
            'leavers' => $this->users->getLeavers(),
            'unassignedDepartment' => $this->users->getUsersWithNoAssignedDepartment(),
            'unassignedRole' => $this->users->getSectorStaffWithNoAssignedRole(),
        ]);
    }

}
