<?php

namespace App\Http\ViewComposers\UserManager;

use App\UserManager\Users\UserRepository;

class RoleManagersComposer
{
    /**
     * @var UserRepository
     */
    protected $users;

    /**
     * @param UserRepository $users
     */
    function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    /**
     * @param $view
     */
    public function compose($view)
    {
        $view->with('roleManagers', $this->users->getDepartmentManagers());
    }

}