<?php

namespace App\Http\Controllers\UserManager;

use App\Http\Controllers\Controller;
use App\UserManager\Users\UserRepository;

class UserTrashController extends Controller
{
    /**
     * @var UserRepository
     */
    private $users;

    /**
     * UserTrashController constructor.
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
        return view(
            'usermanager.users.trashed',
            ['users' => $this->users->getAllTrashedPaginated(20, 'first_name')]
        );
    }
}
